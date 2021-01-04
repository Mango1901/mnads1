<?php

namespace App\Api;


Interface MapRepositoryInterface
{
    /**
     * @param int $userId
     * @return \App\Maps
     */
    public function getMapByUserId($userId);

    /**
     * @param int $userId
     * @param string $map
     * @return \App\Maps
     */
    public function CheckMapName($userId,$map);

    /**
     * @param int $userId
     * @param string $map
     * @param String $mapTitle
     * @return \App\Maps
     */
    public function CreateMap($userId,$map,$mapTitle);

    /**
     * @param int $id
     * @return \App\Maps
     */
    public function getMapById($id);

    /**
     * @param int $id
     * @param int $userId
     * @param string $map
     * @return \App\Maps
     */
    public function CheckMapsNameUpdate($id,$userId,$map);

    /**
     * @param int $id
     * @param string $map
     * @param string $map_title
     * @return \App\Maps
     */
    public function MapsUpdate($id,$map,$map_title);

    /**
     * @param int $id
     * @return \App\Maps
     */
    public function DeleteMaps($id);
}
