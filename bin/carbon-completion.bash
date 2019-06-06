#!/usr/bin/env bash
#/etc/bash_completion.d/carbon-completion.bash
_carbon_completions()
{
  COMPREPLY=($(compgen -W "$(php "$(dirname "${BASH_SOURCE[0]}")/carbon-completion.php" "${COMP_WORDS[1]}" "${COMP_WORDS[2]}")" "${COMP_WORDS[COMP_CWORD]}"))
}

complete -F _carbon_completions carbon
