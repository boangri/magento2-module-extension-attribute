<?php


namespace Boangri\Attribute\Api\Data;


interface CmsPageAttributeInterface
{
    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);
}
