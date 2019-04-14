<?php
defined('ROOT') OR exit('No direct script access allowed');

## Fonction d'installation

function newsInstall(){
}

## Hooks

function newsEndFrontHead(){
	global $runPlugin;
	$core = core::getInstance();
    echo '<link rel="alternate" type="application/rss+xml" href="'.$core->makeUrl('news', array('action' => 'rss')).'" title="'.$core->getConfigVal('siteName').'">'."\n";
	if($runPlugin->getName() == 'news' && $core->getUrlParam(0) == 'read'){
		global $item;
		$pluginsManager = pluginsManager::getInstance();
		if($pluginsManager->isActivePlugin('galerie') && galerie::searchByfileName($item->getImg())) echo '<meta property="og:image" content="'.$core->getConfigVal('siteUrl').'/'.str_replace('./', '', UPLOAD).'galerie/'.$item->getImg().'" />';
	}
}

function newsFooter(){
	$core = core::getInstance();
	$newsManager = new newsManager();
	foreach($newsManager->getItems() as $k=>$v) if(!$v->getDraft() && $k < 3){
		echo '- <a href="'.$core->makeUrl('news', array('action' => 'read', 'name' => util::strToUrl($v->getName()), 'id' => $v->getId())).'">'.$v->getName().'</a>';
		echo '<br>';
	}
}

## Code relatif au plugin

class newsManager{
	private $items;
	private $comments;
	
	public function __construct(){
		$data = array();
		if(file_exists(ROOT.'data/plugin/news/news.json')){
			$temp = util::readJsonFile(ROOT.'data/plugin/news/news.json');
			$temp = util::sort2DimArray($temp, 'date', 'desc');
			foreach($temp as $k=>$v){
				$data[] = new news($v);
			}
		}
		$this->items = $data;
	}
	
	// News
	
	public function getItems(){
		return $this->items;
	}
	
	public function create($id){
		foreach($this->items as $obj){
			if($obj->getId() == $id) return $obj;
		}
		return false;
	}
	
	public function saveNews($obj){
		$id = intval($obj->getId());
		if($id < 1){
			$obj->setId($this->makeId());
			$this->items[] = $obj;
		}
		else{
			foreach($this->items as $k=>$v){
				if($id == $v->getId()) $this->items[$k] = $obj;
			}
		}
		return $this->save();
	}
	
	public function delNews($obj){
		foreach($this->items as $k=>$v){
			if($obj->getId() == $v->getId()) unset($this->items[$k]);
		}
		return $this->save();
	}
	
	public function count(){
		return count($this->items);
	}
	
	public function rss(){
		$core = core::getInstance();
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<rss version="2.0">';
		$xml .= '<channel>';
		$xml .= ' <title>'.$core->getConfigVal('siteName').' - '.pluginsManager::getPluginConfVal('news', 'label').'</title>';
		$xml .= ' <link>'.$core->getConfigVal('siteUrl').'/</link>';
		$xml .= ' <description>'.$core->getConfigVal('siteDescription').'</description>';
		$xml .= ' <language>'.$core->getConfigVal('siteLang').'</language>';
		foreach($this->getItems() as $k=>$v) if(!$v->getDraft()){
			$xml .= '<item>';
			$xml .= '<title><![CDATA['.$v->getName().']]></title>';
			$xml .= '<link>'.$core->getConfigVal('siteUrl').'/'.$core->makeUrl('news', array('action' => 'read', 'name' => util::strToUrl($v->getName()), 'id' => $v->getId())).'</link>';
			$xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($v->getDate()))).'</pubDate>';
			$xml .= '<description><![CDATA['.$v->getContent().']]></description>';
			$xml .= '</item>';
		}
		$xml .= '</channel>';
		$xml .= '</rss>';
		header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');
		header('Content-Type: application/rss+xml; charset=utf-8');
		echo $xml;
		die();
	}
	
	private function makeId(){
		$ids = array(0);
		foreach($this->items as $obj){
			$ids[] = $obj->getId();
		}
		return max($ids)+1;
	}
	
	private function save(){
		$data = array();
		foreach($this->items as $k=>$v){
			$data[] = array(
				'id' => $v->getId(),
				'name' => $v->getName(),
				'content' => $v->getContent(),
				'date' => $v->getDate(),
				'draft' => $v->getDraft(),
				'img' => $v->getImg(),
			);
		}
		if(util::writeJsonFile(ROOT.'data/plugin/news/news.json', $data)) return true;
		return false;
	}
	
	// Comments
	
	public function getComments(){
		return $this->comments;
	}
	
	public function createComment($id){
		foreach($this->comments as $obj){
			if($obj->getId() == $id) return $obj;
		}
		return false;
	}
	
	public function loadComments($idNews){
		if(!file_exists(@mkdir(DATA_PLUGIN.'news/comments/'))) @mkdir(DATA_PLUGIN.'news/comments/');
		if(!file_exists(DATA_PLUGIN.'news/comments/'.$idNews.'.json')) util::writeJsonFile(DATA_PLUGIN.'news/comments/'.$idNews.'.json', array());
		$temp = util::readJsonFile(DATA_PLUGIN.'news/comments/'.$idNews.'.json');
		$temp = util::sort2DimArray($temp, 'id', 'asc');
		$data = array();
		foreach($temp as $k=>$v){
			$data[] = new newsComment($v);
		}
		$this->comments = $data;
	}
	
	public function countComments($idNews = 0){
		if($idNews == 0) return count($this->comments);
		else{
			$this->loadComments($idNews);
			return count($this->comments);
		}
	}
	
	public function saveComment($comment = null, $idNews = null){
		if($comment != null){
			$comment->setId(time());
			$this->comments[] = $comment;
			$idNews = $comment->getIdNews();
		}
		$data = array();
		foreach($this->comments as $k=>$v){
			$data[] = array(
				'id' => $v->getId(),
				'idNews' => $v->getIdNews(),
				'content' => $v->getContent(),
				'date' => $v->getDate(),
				'author' => $v->getAuthor(),
				'authorEmail' => $v->getAuthorEmail(),
			);
		}
		if($comment == null && $idNews != null){
			$idNews = $idNews;
		}
		return util::writeJsonFile(DATA_PLUGIN.'news/comments/'.$idNews.'.json', $data);
	}
	
	public function delComment($obj){
		foreach($this->comments as $k=>$v){
			if($obj->getId() == $v->getId()) unset($this->comments[$k]);
		}
		return $this->saveComment(null, $obj->getIdNews());
	}
}

class news{
	private $id;
	private $name;
	private $date;
	private $content;
	private $draft;
	private $img;
	
	public function __construct($val = array()){
		if(count($val) > 0){
			$this->id = $val['id'];
			$this->name = $val['name'];
			$this->content = $val['content'];
			$this->date = $val['date'];
			$this->draft = $val['draft'];
			$this->img = (isset($val['img']) ? $val['img'] : '');
		}
	}
	
	public function setId($val){
		$this->id = intval($val);
	}
	
	public function setName($val){
		$this->name = trim($val);
	}
	
	public function setContent($val){
		$this->content = trim($val);
	}
	
	public function setDate($val){
		$val = trim($val);
		if($val == '') $val = date('Y-m-d');
		$this->date = $val;
	}
	
	public function setDraft($val){
		$this->draft = trim($val);
	}
	
	public function setImg($val){
		$this->img = trim($val);
	}

	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getContent(){
		return $this->content;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getDraft(){
		return $this->draft;
	}
	
	public function getImg(){
		return $this->img;
	}
}

class newsComment{
	private $id;
	private $idNews;
	private $author;
	private $authorEmail;
	private $date;
	private $content;
	
	public function __construct($val = array()){
		if(count($val) > 0){
			$this->id = $val['id'];
			$this->idNews = $val['idNews'];
			$this->content = $val['content'];
			$this->date = $val['date'];
			$this->author = $val['author'];
			$this->authorEmail = $val['authorEmail'];
		}
	}
	
	public function setId($val){
		$this->id = intval($val);
	}
	
	public function setIdNews($val){
		$this->idNews = intval($val);
	}
	
	public function setAuthor($val){
		$this->author = trim(strip_tags($val));
	}
	
	public function setAuthorEmail($val){
		$this->authorEmail = trim(strip_tags($val));
	}
	
	public function setDate($val){
		$val = trim($val);
		if($val == '') $val = date('Y-m-d');
		$this->date = $val;
	}
	
	public function setContent($val){
		$this->content = trim(strip_tags($val));
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getIdNews(){
		return $this->idNews;
	}
	
	public function getAuthor(){
		return $this->author;
	}
	
	public function getAuthorEmail(){
		return $this->authorEmail;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getContent(){
		return $this->content;
	}
}
?>