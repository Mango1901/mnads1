<?php

namespace App\Repository;

use App\Api\MapRepositoryInterface;
use App\Maps;

class MapRepository implements  MapRepositoryInterface
{
    protected $_MapsModels;

    /**
     * MapRepository constructor.
     * @param Maps $maps
     */
    public function __construct(Maps $maps)
    {
        $this->_MapsModels = $maps;
    }

    /**
     * @param int $userId
     * @return Maps
     */
    public function getMapByUserId($userId){
        return $this->_MapsModels->where("user_id",$userId)->where("status",0)->get();
    }

    /**
     * @param int $userId
     * @param string $map
     * @return Maps
     */
    public function CheckMapName($userId,$map){
        return $this->_MapsModels->where("user_id",$userId)->where("map",$map)->first();
    }

    /**
     * @param int $userId
     * @param string $map
     * @param String $mapTitle
     * @return Maps
     */
    public function CreateMap($userId,$map,$mapTitle){
        return $this->_MapsModels->insert(
            array('user_id'=>$userId,'map'=>$map,'map_title'=>$mapTitle)
        );
    }

    /**
     * @param int $id
     * @return Maps
     */
    public function getMapById($id){
        return $this->_MapsModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param int $userId
     * @param string $map
     * @return Maps
     */
    public function CheckMapsNameUpdate($id, $userId, $map)
    {
       return $this->_MapsModels->where('user_id',$userId)->where('map',$map)->whereNotIn('id',[$id])->first();
    }

    /**
     * @param int $id
     * @param string $map
     * @param string $map_title
     * @return Maps
     */
    public function MapsUpdate($id, $map, $map_title)
    {
      return $this->_MapsModels->where('id',$id)->update(
          array('map'=>$map,'map_title'=>$map_title));
    }

    public function DeleteMaps($id)
    {
     return $this->_MapsModels->where("id",$id)->update(["status"=>1]);
    }
}
