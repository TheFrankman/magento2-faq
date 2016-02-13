<?php
namespace Fc\Faqs\Model\Faq\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Fc\Faqs\Model\Faq
     */
    protected $faq;

    /**
     * Constructor
     *
     * @param \Fc\Faqs\Model\Faq $faq
     */
    public function __construct(\Fc\Faqs\Model\Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->faq->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}