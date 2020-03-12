<?php

namespace Boangri\Attribute\Plugin;

use Boangri\Attribute\Model\CmsPageAttributeFactory;
use Magento\Catalog\Api\Data\ProductExtensionInterfaceFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class CmsPage
{
    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;
    /**
     * @var CmsPageAttributeFactory
     */
    private $modelFactory;
    private $productExtensionFactory;

    /**
     * GetAttributes constructor.
     * @param PageRepositoryInterface $pageRepository
     * @param CmsPageAttributeFactory $cmsPageAttributeFactory
     * @param ProductExtensionInterfaceFactory $productExtensionFactory
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        CmsPageAttributeFactory $cmsPageAttributeFactory,
        ProductExtensionInterfaceFactory $productExtensionFactory
    ) {
        $this->pageRepository = $pageRepository;
        $this->modelFactory = $cmsPageAttributeFactory;
        $this->productExtensionFactory = $productExtensionFactory;
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductInterface $product
     * @return ProductInterface
     * @throws LocalizedException
     */
    public function afterGet(
        ProductRepositoryInterface $productRepository,
        ProductInterface $product
    ) {
        $customAttribute = $product->getCustomAttribute('cms_page_id');
        if (!$customAttribute) {
            return $product;
        }
        $identifier = $customAttribute->getValue();
        $page = $this->pageRepository->getById($identifier);
        if (!$page->getId()) {
            return $product;
        }
        $model = $this->modelFactory->create();
        $model->setTitle($page->getTitle())
            ->setDescription($page->getContent());
        $extensionAttributes = $product->getExtensionAttributes();
        $productExtension = $extensionAttributes ?? $this->productExtensionFactory->create();
        $productExtension->setCmsPage($model);
        $product->setExtensionAttributes($productExtension);

        return $product;
    }
}
