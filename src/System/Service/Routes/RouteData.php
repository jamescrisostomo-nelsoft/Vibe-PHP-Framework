<?php

namespace System\Service\Routes;

class RouteData {

    private $path;
    private $callback;
    private $request_uri;
    private $param = array();

    public function __construct($data, $request_uri) {
        $this->path = $data->path();
        $this->callback = $data->callback();
        $this->request_uri = $request_uri;
        $this->getParam();
    }

    public function path() {
        return $this->path;
    }

    private function getParam() {
        $path = $this->path;
        $size = sizeof($path);
        for($i = 0; $i <= $size - 1; $i++) {
            $item = $path[$i];
            $f = substr($item, 0, 1);
            $m = substr($item, 1, strlen($item) - 2);
            $l = substr($item, strlen($item) - 1, strlen($item));
            if($f === '{' && $l === '}') {
                $data = $this->request_uri[$i];
                $this->param[] = array(

                    'name' => $m,

                    'value' => $data

                );
            }
        }
    }

    public function parameters() {
        return $this->param;
    }

    public function init() {
        $this->callback::main();
    }

}