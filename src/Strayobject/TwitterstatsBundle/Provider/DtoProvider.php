<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Provider;

class DtoProvider
{
    /**
     * @var array
     */
    private $dtoMap;

    public function __construct(array $dtoMap)
    {
        $this->dtoMap = $dtoMap;
    }

    /**
     * @param string $type
     * @param $data
     * @return mixed
     */
    public function getDto(string $type, $data)
    {
        $class = $this->dtoMap[$type];

        if (is_array($data)) {
            return $this->getDtoArray($class, $data);
        }


        return new $class($data);
    }

    /**
     * @param $class
     * @param array $data
     * @return array
     */
    private function getDtoArray($class, array $data): array
    {
        $ret = [];

        foreach($data as $entity) {
            $ret[] = new $class($entity);
        }

        return $ret;
    }
}
