<?php namespace Fc\Faqs\Model;

use Fc\Faqs\Api\Data\FaqInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Faq extends \Magento\Framework\Model\AbstractModel implements FaqInterface, IdentityInterface
{


    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'faqs_faq';

    /**
     * @var string
     */
    protected $_cacheTag = 'faqs_faq';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'faqs_faq';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Fc\Faqs\Model\ResourceModel\Faq');
    }

    /**
     * Prepare faq's statuses.
     * Available event faqs_faq_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Get Faq Identifier
     *
     * @return string|null
     */

    public function getFaqIdentifier()
    {
        return $this->getData(self::FAQ_IDENTIFIER);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get sort order
     *
     * @return int|null
     */

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }

    /**
     * Set URL Key
     *
     * @param string $faq_identifier
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setFaqIdentifier($faq_identifier)
    {
        return $this->setData(self::FAQ_IDENTIFIER, $faq_identifier);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @param string $sort_order
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */

    public function setSortOrder($sort_order) {
        return $this->setData(self::SORT_ORDER, $sort_order);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     * @return \Fc\Faqs\Api\Data\FaqInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

}