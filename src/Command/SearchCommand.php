<?php
/**
 * Global search method console command.
 *
 * PHP version 7.3
 *
 * Copyright (c) 2021-2022 University Of Helsinki (The National Library Of Finland)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @category Skosmos
 * @package  Skosmos-PHP-client
 * @author   Alex Kourijoki <alex.kourijoki@helsinki.fi>
 * @author   Aleksi Peebles <aleksi.peebles@helsinki.fi>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License
 * @link     http://skosmos.org/, https://github.com/NatLibFi/Skosmos, https://github.com/NatLibFi/Skosmos-PHP-Client
 */
namespace NatLibFi\SkosmosClient\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Global search method console command.
 */
class SearchCommand extends AbstractSkosmosCommand
{
    protected static $defaultName = 'skosmos:search';

    protected static $defaultDescription = 'Global search';

    protected const CLIENT_METHOD_NAME = 'search';

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->setHelp('This command allows you to search concepts and collections by query term.');

        // Generate method/command related arguments array.
        $this->commandArgs = [
            new InputArgument(self::ARG_QUERY, InputArgument::REQUIRED, 'The term to search for e.g. "cat*"'),
        ];

        // Generate method/command related options array.
        $this->commandOpts = [
            new InputOption(self::ARG_LANG, null, InputOption::VALUE_REQUIRED, 'Language of labels to match, e.g. "en" or "fi"'),
            new InputOption(self::ARG_LABELLANG, null, InputOption::VALUE_REQUIRED, 'Language of returned labels, e.g. "en" or "fi"'),
            new InputOption(self::ARG_VOCABS, null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Vocabulary/vocabularies to limit search to, e.g. "yso"'),
            new InputOption(self::ARG_TYPE, null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Limit search to concepts of the given type, e.g. "skos:Concept"'),
            new InputOption(self::ARG_PARENT, null, InputOption::VALUE_REQUIRED, 'Limit search to concepts which have the given concept (specified by URI) as parent in their transitive broader hierarchy'),
            new InputOption(self::ARG_GROUP, null, InputOption::VALUE_REQUIRED, 'Limit search to concepts in the given group (specified by URI)'),
            new InputOption(self::ARG_MAXHITS, null, InputOption::VALUE_REQUIRED, 'Maximum number of results to return. If not given, all results will be returned', 0),
            new InputOption(self::ARG_OFFSET, null, InputOption::VALUE_REQUIRED, 'Offset where to start in the result set, useful for paging the result', 0),
            new InputOption(self::ARG_FIELDS, null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Extra fields to include in the results. e.g. "related" or "prefLabel" or any other skos property'),
            new InputOption(self::ARG_UNIQUE, null, InputOption::VALUE_NEGATABLE, 'Boolean flag to indicate that each concept should be returned only once, instead of returning all the different ways it could match (for example both via prefLabel and altLabel) <comment>[default: false]</comment>', false),
        ];

        // Set common input options.
        parent::configure();
        // Set the complete input definition.
        $this->setCommandDefinition();
    }
}
