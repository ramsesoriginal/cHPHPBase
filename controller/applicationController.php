<?php

class ApplicationController extends lib {

	public function Index() {
		//$list = $this->model()::find(); Doesn't work until php 5.3
		$list = call_user_func(array($this->model(), 'find'));
        $this->render($this->model().'/index', compact('list'));
	}

	public function Show($id) {
		//${$this->model()}={$this->model()}::find_by_id($id); Doesn't work until php 5.3
		$model=$this->model();
		$$model = call_user_func(array($this->model(), 'find_by_id'),array($id));
        $this->render($this->model().'/show', compact($this->model()));
	}

	public function Edit($id, $object=false) {
		$model=$this->model();
		if (!$object) {
			//${$this->model()}={$this->model()}::find_by_id($id); Doesn't work until php 5.3
			$$model = call_user_func(array($this->model(), 'find_by_id'),array($id));
		} else {
			//${$this->model()}=$object; Doesn't work until php 5.3
			$$model=$object;
		}
        $this->render($this->model().'/edit', compact($this->model()));
	}

	/*Can't use new, it's a reserved word*/
	public function Fresh() {
        $this->render($this->model().'/fresh');
	}

	public function Update($id,$object) {
		$model=$this->model();
		//${$this->model()}={$this->model()}::find_by_id($id);Doesn't work until php 5.3
		$$model = call_user_func(array($this->model(), 'find_by_id'),array($id));
		//${$this->model()}->update($object);Doesn't work until php 5.3
		call_user_func(array($$model, 'update'), array($object));
		if ($this->model_ok()) {
			//${$this->model()}->save();Doesn't work until php 5.3
			$this->show($id);
		}
		else
			$this->edit($id, $object);
	}

	public function Create($object) {
		$model=$this->model();
		//${$this->model()} = {$this->model()}::create($object);Doesn't work until php 5.3
		$$model = call_user_func(array($this->model(), 'create'),array($object));
		if ($this->model_ok())
			$this->show($object->id);
		else
			$this->edit($object->id, $object);
	}

	public function Destroy($id) {
		$model=$this->model();
		//${$this->model()}={$this->model()}::find_by_id($id);Doesn't work until php 5.3
		$$model = call_user_func(array($this->model(), 'find_by_id'),array($id));
		//${$this->model()}->delete();Doesn't work until php 5.3
		call_user_func(array($$model, 'delete'));
		if ($this->model_ok())
			$this->index();
		else
			$this->show($object->id);
	}

    protected function preRender() {
		//$this->flash({$this->model()}::flash());Doesn't work until php 5.3
		$this->flash(call_user_func(array($this->model(), 'flash')));
		//$this->error({$this->model()}::error());Doesn't work until php 5.3
		$this->error(call_user_func(array($this->model(), 'error')));
    }

    protected function model_ok() {
    	//return empty({$this->model()}::error());Doesn't work until php 5.3
    	$error= call_user_func(array($this->model(), 'error'));
		return empty($error);
    }
}

?>