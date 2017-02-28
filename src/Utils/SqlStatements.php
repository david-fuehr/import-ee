<?php

/**
 * TechDivision\Import\Ee\Utils\SqlStatements
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Ee\Utils;

/**
 * Utility class with the SQL statements to use.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-ee
 * @link      http://www.techdivision.com
 */
class SqlStatements extends \TechDivision\Import\Utils\SqlStatements
{

    /**
     * The SQL statement to load all available categories.
     *
     * @var string
     */
    const CATEGORIES = 'SELECT t0.*,
                               (SELECT `value`
                                  FROM eav_attribute t1, catalog_category_entity_varchar t2
                                 WHERE t1.attribute_code = \'name\'
                                   AND t1.entity_type_id = 3
                                   AND t2.attribute_id = t1.attribute_id
                                   AND t2.store_id = 0
                                   AND t2.row_id = t0.row_id) AS name,
                               (SELECT `value`
                                  FROM eav_attribute t1, catalog_category_entity_varchar t2
                                 WHERE t1.attribute_code = \'url_key\'
                                   AND t1.entity_type_id = 3
                                   AND t2.attribute_id = t1.attribute_id
                                   AND t2.store_id = 0
                                   AND t2.row_id = t0.row_id) AS url_key,
                               (SELECT `value`
                                  FROM eav_attribute t1, catalog_category_entity_varchar t2
                                 WHERE t1.attribute_code = \'url_path\'
                                   AND t1.entity_type_id = 3
                                   AND t2.attribute_id = t1.attribute_id
                                   AND t2.store_id = 0
                                   AND t2.row_id = t0.row_id) AS url_path
                          FROM catalog_category_entity AS t0';

    /**
     * The SQL statement to load the category varchars for a list of entity IDs.
     *
     * @var string
     */
    const CATEGORY_VARCHARS_BY_ENTITY_IDS = 'SELECT t1.*
                                               FROM catalog_category_entity AS t0
                                         INNER JOIN catalog_category_entity_varchar AS t1
                                                 ON t1.row_id = t0.row_id
                                         INNER JOIN eav_attribute AS t2
                                                 ON t2.entity_type_id = 3
                                                AND t2.attribute_code = \'name\'
                                                AND t1.attribute_id = t2.attribute_id
                                                AND t1.store_id = 0
                                                AND t0.entity_id IN (?)';
}
