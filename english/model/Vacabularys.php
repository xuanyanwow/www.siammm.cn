<?php
use think\Model;


class Vacabularys extends Model{
    protected $name = 'vacabularys';

    public function root()
    {
        return $this->hasOne(self::class,'vacabulary_content','vacabulary_root');
    }

    public function getSubAttr($value)
    {
        // 按,分割vacabulary_sub   然后where In
        $sub = explode(',',$this->vacabulary_sub ?? '');
        $sub = Vacabularys::where('vacabulary_content','in',$sub)->select();
        return $sub;
    }

    public function getMoreAttr($value)
    {
        $sub = Vacabularys::where('vacabulary_root','=',$this->vacabulary_content,'or')->whereRaw('FIND_IN_SET(vacabulary_sub,"'.$this->vacabulary_content.'") != 0',[],'or')->select();
        return $sub;
    }

}