<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Provider;

use NilPortugues\Symfony\JsonApiBundle\Serializer\JsonApiSerializer;

class SerializedDataProvider
{
    /**
     * @var DtoProvider
     */
    private $dtoProvider;
    /**
     * @var JsonApiSerializer
     */
    private $serializer;

    /**
     * SerializedDataProvider constructor.
     * @param DtoProvider $dtoProvider
     * @param JsonApiSerializer $serializer
     */
    public function __construct(
        DtoProvider $dtoProvider,
        JsonApiSerializer $serializer
    ) {
        $this->dtoProvider = $dtoProvider;
        $this->serializer = $serializer;
    }

    /**
     * @param string $type
     * @param mixed $data
     * @param LinkProvider $links
     * @return string
     */
    public function serializeData(string $type, $data, LinkProvider $links): string
    {
        $dto = $this->dtoProvider->getDto($type, $data);
        $this->serializer->getTransformer()->setSelfUrl($links->getSelfUrl());

        return $this->serializer->serialize($dto);
    }
}
