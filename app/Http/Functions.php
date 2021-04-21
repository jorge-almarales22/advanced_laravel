<?php  
//key value from Json
function kvfj($arr, $key)
{
	if($arr == null){
		return false;
	}
	else{
		if(array_key_exists($key, $arr)){
			return $arr[$key];
		}
		else{
			return false;
		}
	}
}

//@if(kvfj($groups->toArray(), $item->id)) checked @endif 