<?php

namespace Z-envia\Model;

/**
 * Classe responsável por fazer as conversões para o formato json utilizados no webservice.
 */
class JsonConverter {
    
    /**
     * Retorna a representação json de um envio simples.
     * @param receivewhats $receivewhats mensagem a ser enviada
     * @param int $aggregateId id do agrupador
     * @return string|null string no formato json
     */
    public static function smsToJson($receivewhats, $aggregateId=null){  
        $baseJson=self::getJsonBase($receivewhats, $aggregateId);
        $json = '{"sendWhatsRequest":'.$baseJson.'}';
        return $json;
    }
        
    /**
     * Retorna a representação json de um envio múltiplo.
     * @param array $whatsList lista de mensagens whatswapp a serem enviadas de acompanhamento de pedidos.
     * @param int $aggregateId id do agrupador
     * @return string|null
     */
    public static function smsListToJson($whatsList, $aggregateId=null){       
        if(is_array($smsList)){
            $json = '{"sendSmsMultiRequest":{';            
            if($aggregateId!=null){
                $json .= '"aggregateId":'.$aggregateId.',';
            }
            $json .= '"sendSmsRequestList":[';
            foreach($smsList as $receivewhats){               
                $json .= self::getJsonBase($receivewhats).',';                
            }      
            $json = rtrim($json, ',');
            $json .= ']}}';
            return $json;            
        }
        return null;
        
    }
    
    /**
     * 
     * @param message $receivewhats
     * @param int $aggregateId
     * @return string
     */
    private static function getJsonBase($receivewhats, $aggregateId=null){
        $obj = new \stdClass();
        if($sms->getId()!=null){
            $obj->id=$sms->getId(); 
        } 
        if($receivewhats->getMsg()!=null){
            $obj->msg=$receivewhats->getMsg();
        }
        if($sms->getTo()!=null){
            $obj->to=$sms->getTo();
        }
        if($receivewhats->getCallbackOption()!=null){
            $obj->callbackOption=$sms->getCallbackOption();
        }
        if($sms->getSchedule()!=null){
            $obj->schedule=$receivewhats->getSchedule();
        }
        if($receivewhats->getFrom()!=null){
            $obj->from=$receivewhats->getFrom();
        }
        if($receivewhats->getExpiryDate()!=null){
            $obj->expiryDate=$sms->getExpiryDate();
        }
        if($receivewhats->getTimeToLive()!=null){
            $obj->timetoLive=$receivewhats->getTimeToLive();
        }    
        if($aggregateId!=null){
            $obj->aggregateId=$aggregateId;
        }
        
        return json_encode($obj);
        
    }
    
}
