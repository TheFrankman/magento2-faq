<?php
namespace Fc\Faqs\Model\ResourceModel;

/**
 * Faq mysql resource
 */
class Faq extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('fc_faqs_faq', 'faq_id');
    }

    /**
     * Process faq data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        /**
         * @todo validate identifier
         */

        /*if (!$this->isValidFaqIdentifier($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The Faq URL key contains capital letters or disallowed symbols.')
            );
        }*/

        /*if ($this->isNumericFaqIdentifier($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The Faq URL key cannot be made of only numbers.')
            );
        }*/

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * Load an object using 'faq_identifier' field if there's no field specified and value is not numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param string $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'faq_identifier';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Fc\Faq\Model\Faq $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {

            $select->where(
                'is_active = ?',
                1
            )->limit(
                    1
                );
        }

        return $select;
    }

    /**
     * Retrieve load select with filter by faq_identifier and activity
     *
     * @param string $faq_identifier
     * @param int $isActive
     * @return \Magento\Framework\DB\Select
     */

    /**
     * @todo load by faq_identfier i guess
     */

    protected function _getLoadByFaqIdentifierSelect($faq_identifier, $isActive = null)
    {
        $select = $this->getConnection()->select()->from(
            ['faqs' => $this->getMainTable()]
        )->where(
                'faqs.faq_identifier = ?',
                $faq_identifier
            );

        if (!is_null($isActive)) {
            $select->where('faqs.is_active = ?', $isActive);
        }

        return $select;
    }

    /**
     * @todo do we need this ?
     *  Check whether faq url key is numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    /*protected function isNumericFaqIdentifier(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[0-9]+$/', $object->getData('faq_identifier'));
    }*/

    /**
     * @todo do we need this ?
     *  Check whether faq url key is valid
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isValidFaqIdentifier(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('faq_identifier'));
    }

    /**
     * Check if faq url key exists
     * return faq id if faq exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkFaqIdentifier($faq_identifier)
    {
        $select = $this->_getLoadByFaqIdentifierSelect($faq_identifier, 1);
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('faqs.faq_id')->limit(1);

        return $this->getConnection()->fetchOne($select);
    }
}