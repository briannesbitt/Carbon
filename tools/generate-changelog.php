<?php
require __DIR__ . '/../vendor/autoload.php';

use Carbon\Carbon;
use SebastianFeldmann\Git\Log\Commit;
use SebastianFeldmann\Git\Repository;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\ProgressIndicator;
use Symfony\Component\Console\Output\ConsoleOutput;

function get_data(string $url)
{
	$handler = curl_init($url);
	curl_setopt($handler, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handler, CURLOPT_HEADER, 'X-GitHub-Api-Version: 2023-11-01');

	$json = curl_exec($handler);

	if (!is_string($json)) {
		echo curl_errno($handler) . ': ' . curl_error($handler) . "\n";
		curl_close($handler);
		exit(1);
	}

	curl_close($handler);

	// get headers
	$headers = curl_getinfo($handler);
	$response_code = $headers['http_code'] ?? 0;
	if ($response_code !== 200) {
		throw new RuntimeException("\nGitHub API returned response code $response_code");
	}
	return json_decode($json, true);
}

function get_releases_from_api()
{
	$output = new ConsoleOutput();
	$progress_indicator = new ProgressIndicator($output);
	$progress_indicator->start('Fetching releases from GitHub API...');

	$releases = array();
	$page = 0;
	do {
		$page++;
		$data = get_data("https://api.github.com/repos/briannesbitt/Carbon/releases?page=$page");

		foreach ($data as $release) {
			$properties = array(
				'tag_name' => $release['tag_name'],
				'created_at' => $release['created_at'],
			);

			if (isset($release['assets'], $release['assets'][0], $release['assets'][0]['asset_url'])) {
				$properties['asset_url'] = $release['assets'][0]['asset_url'];
			}

			$releases[] = $properties;
		}
	} while (count($data) > 0);

	$progress_indicator->finish('Fetched releases from GitHub API.');
	return $releases;
}

function get_releases()
{
	if (!file_exists(__DIR__ . '/../releases.json')) {
		$releases = get_releases_from_api();
		file_put_contents(__DIR__ . '/../releases.json', json_encode($releases, JSON_PRETTY_PRINT));
	} else {
		$releases = json_decode(file_get_contents(__DIR__ . '/../releases.json'), true);
	}

	// sort releases by version descending
	usort($releases, function($a, $b) {
			return version_compare($b['tag_name'], $a['tag_name']);
		});

	// group by major version
	$grouped_releases = array();
	foreach ($releases as $release) {
		$version = preg_replace('/^v/', '', $release['tag_name']);
		$major_version = explode('.', $version) [0];
		$grouped_releases[$major_version][] = $release;
	}

	return $grouped_releases;
}

function get_commites_markdown($commits)
{
	$markdown = '';

	// ensure commits subjects are unique
	$unique_commits = array();
	foreach ($commits as $commit) {
		$subject = $commit->getSubject();
		if (!isset($unique_commits[$subject])) {
			$unique_commits[$subject] = $commit;
		}
	}

	// sort by date
	usort($unique_commits, function(Commit $a, Commit $b) {
			return $b->getDate() <=> $a->getDate();
		});

	foreach ($unique_commits as $commit) {
		$markdown .= "- {$commit->getSubject()} ({$commit->getAuthor()}) [{$commit->getHash()}]\n";
	}

	return $markdown;
}

function write_markdown()
{
	$destination_file = __DIR__ . '/../docs/develop/changelog.md';
	$git_repository = new Repository(__DIR__ . '/../');

	$releases = get_releases();
	$releases_count = array_sum(array_map('count', $releases));
	$output = new ConsoleOutput();
	$progress_bar = new ProgressBar($output, $releases_count - 1);
	$progress_bar->setFormat('debug');
	$progress_bar->start();
	$markdown = "<!-- This file is auto generated using tools/generate-changelog.php -->\n\n";
	$markdown .= "# Changelog\n";

	foreach ($releases as $major_version => $release_group) {
		$markdown .= "\n## Version {$major_version}.x\n\n";

		// only get commits for version 3.0.0 and above
		if (version_compare($major_version, '3', '<')) {
			$markdown .= "::: tip Info\n";
			$markdown .= "Only release dates are listed here.\n";
			$markdown .= ":::\n\n";

			// display a list of releases without commits
			foreach ($release_group as $release) {
				$tag = $release['tag_name'];
				$markdown .= "- {$tag} (" . Carbon::parse($release['created_at'])->format('j F Y') . ")\n";
				$progress_bar->advance();
			}
			continue;
		}

		foreach ($release_group as $release) {
			$tag = $release['tag_name'];

			if (empty($previous_tag)) {
				$previous_tag = $tag;
				continue;
			}

			$start = $tag;
			$end = $previous_tag;
			$markdown .= "#### {$end} (" . Carbon::parse($release['created_at'])->format('j F Y') . ")\n";

			$commits = $git_repository->getLogOperator()->getCommitsBetween($start, $end);
			$markdown .= get_commites_markdown($commits);
			$progress_bar->advance();
			$previous_tag = $tag;
		}
	}
	$progress_bar->finish();

	file_put_contents($destination_file, $markdown);
}

try {
	write_markdown();
} catch (Exception $exception) {
	echo 'Error: ' . $exception->getMessage() . "\n";
	exit(1);
}