<?php


namespace Boangri\Attribute\Model;


use Boangri\Attribute\Api\Data\CmsPageAttributeInterface;

class CmsPageAttribute implements CmsPageAttributeInterface
{
    private $title;
    private $description;
    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }
}
