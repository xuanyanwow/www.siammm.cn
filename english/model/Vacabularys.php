<?php
use think\Model;


class Vacabularys extends Model{
    protected $name = 'vacabularys';

    public function root()
    {
        return $this->hasOne(self::class,'vacabulary_root','vacabulary_content');
    }

    public function getSubAttr($value)
    {
        // vacabulary_sub 按,分割   然后whereIn查询
        $sub = explode(',',$this->vacabulary_sub ?? '');
        $sub = Vacabularys::where('vacabulary_content','in',$sub)->select();
        return $sub;
    }

}