<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
		$searchForm = new Form_SearchForm();
		$searchForm->showfilters();
		$searchForm->removeElement('keyword');
		$this->view->advSearch = $searchForm;
		$sysModel = new Model_DbTable_Gtsystems();
		$system = $sysModel->fetchAll();		
		
        if($this->_getParam('keyword',"") != "")
		{
			$query = $this->_getParam('keyword',"");
		}
		if($this->_getParam('plantname',"") != "")
		{
			$query = $query . " " . $this->_getParam('plantname',"");
		}
		if($this->_getParam('type',"") != "")
		{
			$query = $query . " " . $this->_getParam('type',"");
		}
		if($this->_getParam('sysname',"") != "")
		{
			$query = $query . " " . $this->_getParam('sysname',"");
		}
		if($this->_getParam('subsysname',"") != "")
		{
			$query = $query . " " . $this->_getParam('subsysname',"");
		}
		if($this->_getParam('toi',"") != "")
		{
			$query = $query . " " . $this->_getParam('toi',"");
		}
		$this->view->query = $query;
		$this->view->eoh = $this->_getParam('eoh',"");
		if(isset($_GET['keyword']))
		{
			$this->view->keyword = $_GET['keyword'];
		}
		$this->view->nature = $this->_getParam('nature');
    }
	
	public function searchmatrixAction()
	{
		$searchForm = new Form_SearchForm();
		$searchForm->showfilters();
		$searchForm->removeElement('keyword');
		$this->view->advSearch = $searchForm;
	}
	
	public function viewAction()
	{
		
		if($this->getRequest()->isGet())
		{
			$cat = $this->_getParam('cat');
			$ll = $this->_getParam('ll');
			$ul = $this->_getParam('ul');
			$eoh = $this->_getParam('eoh');
			
			if  ($eoh != "")
			{
				$from =  substr($eoh,0,strlen($eoh)-(strpos($eoh,"-")+1));
				$to = substr($eoh,strpos($eoh,"-")+1);
				$from = (int)$from - ((int)$from % 5000);
				$to = (int)$to - ((int)$to % 5000);
				$this->view->eohfrom = $from;
				$this->view->eohto = $to;
			}
			$queryStr = $this->_getParam('keyword',0);
			$this->_helper->getHelper('layout')->disableLayout();
			$t1= time();
			$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
			$path = $appath . DIRECTORY_SEPARATOR . "search" . DIRECTORY_SEPARATOR . "gtdata";
			$index = Zend_Search_Lucene::open($path);
			$qarray = explode(" ",$queryStr);
			$valid = true;
			foreach($qarray as $q)
			{
				if(strlen($q) <= 2)
				{
					$valid = false;
				}
			}
			if($valid)
				$queryStr = $queryStr . "*";
			Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive());
			if($eoh != "")
  				$results = $index->find($queryStr . " OR eoh:[$from TO $to]");
			else 
				$results = $index->find($queryStr);
			
			
			if($cat == "gt")
			{
				$gtdatamodel = new Model_DbTable_Gtdata();
				$plantmodel  = new Model_DbTable_Plant();
				$umodel = new Model_DbTable_Userprofile();
				$gtmodel = new Model_DbTable_Gasturbine();
				$gtsysmodel = new Model_DbTable_Gtsystems();
				$gtsubsysmodel = new Model_DbTable_Gtsubsystems();
				$count = 0;
				$type['finding'] = "findings";
				$type['upgrade'] = "upgrades";
				$type['lte'] = "lte";
				$i = 1;
				foreach($results as $result)
				{
					if($i<$ll || $i > $ul)
					{
						$i++;
						continue;
					}
					$i++;
					
					$data[$count]['id'] = $result->dataid;
					
					$gtdataid = $data[$count]['id'];
					
					$gtdata = $gtdatamodel->getData($gtdataid);
					if(!count($gtdata))
					{
						continue;
					}
					$user = $umodel->getUser($gtdata['userupdate']);
					$uplant = $plantmodel->getPlant($user['plantId']);
					$uplantname = $uplant['plantName'];
					
					$sys = $gtsysmodel->getSystem($gtdata['sysId']);
					$sysname = $sys['sysName'];
					$subsys = $gtsubsysmodel->getSubSystem($gtdata['subSysId']);
					$subsysname = $subsys['subSysName'];
					$data[$count]['url'] = "/" . $type[$gtdata['type']] . "/view?id=" . $data[$count]['id'];				
					$data[$count]['gtid'] = $gtdata['gtid'];
					$data[$count]['updatedate'] = $gtdata['updatedate'];
					$data[$count]['data'] = $gtdata['data'];
					$data[$count]['type'] = $gtdata['type'];
					$data[$count]['userupdate'] = $gtdata['userupdate'];
					$data[$count]['userplantname'] = $uplantname;
					$data[$count]['sysname'] = $sysname;
					$data[$count]['subsysname'] = $subsysname;
					$data[$count]['eoh'] = $gtdata['EOH'];
					$data[$count]['toi'] = $gtdata['TOI'];
					$data[$count]['dof'] = $gtdata['DOF'];
					$data[$count]['title'] = $gtdata['title'];
					$data[$count]['score'] = $result->score;	
					$count++;
				}
				
				$this->view->searchData = $data;
				$this->view->tgr = $i-1;
			}
			
			$count = 0;
			
			if($cat == "forum")
			{
				
				$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
				$path = $appath . DIRECTORY_SEPARATOR . "search" . DIRECTORY_SEPARATOR . "forum";
				$forumIndex = Zend_Search_Lucene::open($path);
				
				$results = $forumIndex->find($queryStr . " OR eoh:[$from TO $to]");
				
				$forummodel = new Model_DbTable_Forum_Data();
				$postmodel = new Model_DbTable_Forum_Posts();
				$topicsmodel = new Model_DbTable_Forum_Topics();
				$umodel = new Model_DbTable_Userprofile();
				$plantmodel = new Model_DbTable_Plant();
				
				$i=1;
				$tc=0;
				foreach($results as $result)
				{
						
					if($i<$ll || $i > $ul)
					{
						continue;
					}
					$i++;
					$fdata[$count]['post_id'] = $result->post_id;
					$pid = $fdata[$count]['post_id'];
					$post = $postmodel->getPost($pid);
					if(!count($post))
					{
						$i--;
						continue;
						
					}
					$fid = $post['forum_id'];
					$tid = $post['topic_id'];
					$uid = $post['poster_id'];
					
					$user = $umodel->getUser($uid);
					$uplant = $plantmodel->getPlant($user['plantId']);
					$uplantname = $uplant['plantName'];
					$topic = $topicsmodel->getTopic($tid);
					$topicname = $topic['topic_title'];
					$forum = $forummodel->getForum($fid);
					$forumname = $forum['forum_name'];
					
					$fdata[$count]['url'] = "/forums/viewtopic.php?f=" .$fid ."&t=".$tid."&p=".$pid."#p".$pid;
					$fdata[$count]['post_id'] = $pid;
					$fdata[$count]['topic_id'] = $tid;
					$fdata[$count]['forum_id'] = $fid;
					$fdata[$count]['poster_id'] = $uid;
					$fdata[$count]['post_subject'] = $post['post_subject'];
					$fdata[$count]['post_text'] = $post['post_text'];
					$fdata[$count]['topicname'] = $topicname;
					$fdata[$count]['forumname'] = $forumname;
					$fdata[$count]['userplantname'] = $uplantname;
					$fdata[$count]['lucene_id'] = $result->id;
								
					$count++;
					
				}
				
				$this->view->forumData = $fdata;
				$this->view->fgr = $i-1;
				
			}
			if($ul > $i)
			{
				$ul = $i-1;
			}
			$this->view->ll = $ll;
			$this->view->ul = $ul;
			$this->view->queryStr = $queryStr;
			$t2=time();	                	 
		}

   	}
	
	public function searchindexAction()
	{
		//indexing gtdata//
		
		$gtdatamodel = new Model_DbTable_Gtdata();
		$gtdata = $gtdatamodel->fetchAll();
		/*$type['finding'] = "Finding";
		$type['upgrade'] = "Upgrade";
		$type['lte'] = 'LTE';*/
		$umodel = new Model_DbTable_Userprofile();
		$upmodel = new Model_DbTable_Plant();
		$sysmodel = new Model_DbTable_Gtsystems();
		$subsysmodel = new Model_DbTable_Gtsubsystems();
		$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
		$path = $appath . DIRECTORY_SEPARATOR . "search" . DIRECTORY_SEPARATOR . "gtdata";
		$index = Zend_Search_Lucene::create($path);
		
		foreach($gtdata as $list)
		{
			echo $list['id'] . "  " . $list['title'] . "<br>";
			
			$user = $umodel->getUser($list['userupdate']);
			
			$uplant = $upmodel->getPlant($user['plantId']);
			$uplantname = $uplant['plantName'];
			
			$sysname = $sysmodel->getSystem($list['sysId']);
			$sysname = $sysname['sysName'];
			
			$eoh = $list['EOH'];
			$toi = $list['TOI'];
			
			if($list['subSysId'] != 34 && $list['subSysId'] != 0)
			{
				$subsysname = $subsysmodel->getSubSystem($list['subSysId']);
				$subsysname = $subsysname['subSysName'];
			}
			
			$doc = new Zend_Search_Lucene_Document();
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('dataid',$list['id']));
			
			$doc->addField(Zend_Search_Lucene_Field::UnStored('title',$list['title']));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('data',$list['data']));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('type',$list['type']));
			
			$doc->addField(Zend_Search_Lucene_Field::UnStored('sysname',$sysname));  
			$doc->addField(Zend_Search_Lucene_Field::UnStored('subsysname',$subsysname));
			$doc->addField(Zend_Search_Lucene_Field::Keyword('eoh',$eoh));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('toi',$toi));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('userplantname',$uplantname));
			
			$index->addDocument($doc);
		}
		$index->commit();  
		$index->optimize();
		
		//forum data indexing//
		
		$forumPostModel = new Model_DbTable_Forum_Posts();
		$forumPosts = $forumPostModel->getFieldsForSearch();
		
		
		$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
		$path = $appath . DIRECTORY_SEPARATOR . "search" . DIRECTORY_SEPARATOR . "forum";
		$index = Zend_Search_Lucene::create($path);
		$topicmodel = new Model_DbTable_Forum_Topics();
		$forummodel = new Model_DbTable_Forum_Data();
		$posterModel = new Model_DbTable_Userprofile();
		$plantmodel = new Model_DbTable_Plant();
		
		foreach($forumPosts as $list)
		{
			$doc = new Zend_Search_Lucene_Document();
			
			$topic = $topicmodel->getTopic($list['topic_id']);
			$topicname = $topic['topic_title'];
			
			$forum = $forummodel->getForum($list['forum_id']);
			$forumname = $forum['forum_name'];
			
			$poster = $posterModel->getUser($list['poster_id']);
			
			$plant = $plantmodel->getPlant($poster['plantId']);
			$uplantname = $plant['plantName'];
			
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_id',$list['post_id']));
			
			$doc->addField(Zend_Search_Lucene_Field::UnStored('post_subject',$list['post_subject']));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('post_text',$list['post_text']));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('topicname',$topicname));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('forumname',$forumname));
			
			$doc->addField(Zend_Search_Lucene_Field::UnStored('userplantname',$uplantname));
			$index->addDocument($doc);
			}
		$index->commit();  
		$index->optimize();
		$this->_redirect("/dashboard/index");
	}

	public function searchlayoutAction()
	{		
                if (!$this->_request->isXmlHttpRequest())
                    $this->_helper->viewRenderer->setResponseSegment('searchlayout');
	}

	
	
}
