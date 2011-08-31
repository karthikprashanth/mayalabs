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
		$this->view->query = $query;
		if(isset($_GET['keyword']))
		{
			$this->view->keyword = $_GET['keyword'];
		}
    }
	
	public function searchmatrixAction()
	{
		$searchForm = new Form_SearchForm();
		$searchForm->showfilters();
		//$searchForm->showSubmit();
		//$searchForm->submit->setLabel("Search");
		$this->view->form = $searchForm;
	}
	
	public function viewAction()
	{
		
		if($this->getRequest()->isGet())
		{
			$queryStr = $this->_getParam('keyword',0);
			$this->_helper->getHelper('layout')->disableLayout();
			$t1= time();
			$index = Zend_Search_Lucene::open("/var/www/hivelive/search/gtdata");
			$queryStr = $queryStr."*";
			$query = Zend_Search_Lucene_Search_QueryParser::parse($queryStr);
  			$results = $index->find($query);
			$count = 0;
			foreach($results as $result)
			{
				$data[$count]['url'] = $result->url;
				$data[$count]['id'] = $result->id;
				$data[$count]['gtid'] = $result->gtid;
				$data[$count]['updatedate'] = $result->updatedate;
				$data[$count]['data'] = $query->highlightMatches($result->data);
				$data[$count]['type'] = $query->highlightMatches($result->type);
				$data[$count]['username'] = $query->highlightMatches($result->username);
				$data[$count]['sysname'] = $query->highlightMatches($result->sysname);
				$data[$count]['subsysname'] = $query->highlightMatches($result->subsysname);
				$data[$count]['userplantname'] = $query->highlightMatches($result->userplantname);
				$data[$count]['userupdate'] = $result->userupdate;
				$data[$count]['sysId'] = $result->sysId;
				$data[$count]['subSysId'] = $result->subSysId;
				$data[$count]['title'] = $query->highlightMatches($result->title);
				$data[$count]['score'] = $result->score;
				$count++;
			}
			
			$forumIndex = Zend_Search_Lucene::open("/var/www/hivelive/search/forum");
			$results = $forumIndex->find($query);
			
			$count = 0;
			foreach($results as $result)
			{
				$fdata[$count]['url'] = $result->url;
				$fdata[$count]['post_id'] = $result->post_id;
				$fdata[$count]['topic_id'] = $result->topic_id;
				$fdata[$count]['forum_id'] = $result->forum_id;
				$fdata[$count]['poster_id'] = $result->poster_id;
				$fdata[$count]['post_subject'] = $query->highlightMatches($result->post_subject);
				$fdata[$count]['forumname'] = $query->highlightMatches($result->forumname);
				$fdata[$count]['topicname'] = $query->highlightMatches($result->topicname);
				$fdata[$count]['postername'] = $query->highlightMatches($result->postername);
				$fdata[$count]['userplantname'] = $query->highlightMatches($result->userplantname);
				$fdata[$count]['post_text'] = $query->highlightMatches($result->post_text);
				
				$count++;
			}
			$this->view->queryStr = $queryStr;
			$this->view->searchData = $data;
			$this->view->forumData = $fdata;
			$t2=time();
			echo "Mass ".$t2-$t1;	                	 
		}

   	}
	
	public function searchindexAction()
	{
		//indexing gtdata//
		
		$gtdatamodel = new Model_DbTable_Gtdata();
		$gtdata = $gtdatamodel->fetchAll();
		$type['finding'] = "findings";
		$type['upgrade'] = "upgrades";
		$type['lte'] = 'lte';
		
		$index = Zend_Search_Lucene::create('/var/www/hivelive/search/gtdata');
		
		foreach($gtdata as $list)
		{
			$umodel = new Model_DbTable_Userprofile();
			$user = $umodel->getUser($list['userupdate']);
			$username = $user['firstName'] . " " . $user['lastName'];
			$upmodel = new Model_DbTable_Plant();
			$uplant = $upmodel->getPlant($user['plantId']);
			$uplantname = $uplant['plantName'];
			$sysmodel = new Model_DbTable_Gtsystems();
			$sysname = $sysmodel->getSystem($list['sysId']);
			$sysname = $sysname['sysName'];
			$subsysmodel = new Model_DbTable_Gtsubsystems();
			$subsysname = $subsysmodel->getSubSystem($list['subSysId']);
			$subsysname = $subsysname['subSysName'];
			$doc = new Zend_Search_Lucene_Document();
			$doc->addField(Zend_Search_Lucene_Field::Keyword('url',
			"http://www.hiveusers.com/" . $type[$list['type']] . "/view?id=" .$list['id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('id',$list['id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('gtid',$list['gtid']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('updatedate',$list['updatedate']));
			$doc->addField(Zend_Search_Lucene_Field::Text('title',$list['title']));
			$doc->addField(Zend_Search_Lucene_Field::Text('data',$list['data']));
			$doc->addField(Zend_Search_Lucene_Field::Text('type',$list['type']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('userupdate',$list['userupdate']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('sysId',$list['sysId']));  
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('subSysId',$list['subSysId']));
			$doc->addField(Zend_Search_Lucene_Field::Text('username',$username));
			$doc->addField(Zend_Search_Lucene_Field::Text('sysname',$sysname));  
			$doc->addField(Zend_Search_Lucene_Field::Text('subsysname',$subsysname));
			$doc->addField(Zend_Search_Lucene_Field::Text('userplantname',$uplantname));
			
			$index->addDocument($doc);
		}
		$index->commit();  
		$index->optimize();
		
		//forum data indexing//
		
		$forumPostModel = new Model_DbTable_Forum_Posts();
		$forumPosts = $forumPostModel->getFieldsForSearch();
		
		
		$index = Zend_Search_Lucene::create('/var/www/hivelive/search/forum');
		
		foreach($forumPosts as $list)
		{
			$doc = new Zend_Search_Lucene_Document();
			$topicmodel = new Model_DbTable_Forum_Topics();
			$topic = $topicmodel->getTopic($list['topic_id']);
			$topicname = $topic['topic_title'];
			$forummodel = new Model_DbTable_Forum_Data();
			$forum = $forummodel->getForum($list['forum_id']);
			$forumname = $forum['forum_name'];
			$posterModel = new Model_DbTable_Userprofile();
			$poster = $posterModel->getUser($list['poster_id']);
			$postername = $poster['firstName'] . " " . $poster['lastName'];
			$plantmodel = new Model_DbTable_Plant();
			$plant = $plantmodel->getPlant($poster['plantId']);
			$uplantname = $plant['plantName'];
			$doc->addField(Zend_Search_Lucene_Field::Keyword('url',
			"/forums/viewtopic.php?f=" .$list['forum_id'] ."&t=".$list['post_id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_id',$list['post_id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('forum_id',$list['forum_id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('topic_id',$list['topic_id']));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('poster_id',$list['poster_id']));
			$doc->addField(Zend_Search_Lucene_Field::Text('post_subject',$list['post_subject']));
			$doc->addField(Zend_Search_Lucene_Field::Text('post_text',$list['post_text']));
			$doc->addField(Zend_Search_Lucene_Field::Text('topicname',$topicname));
			$doc->addField(Zend_Search_Lucene_Field::Text('forumname',$forumname));
			$doc->addField(Zend_Search_Lucene_Field::Text('postername',$postername));
			$doc->addField(Zend_Search_Lucene_Field::Text('userplantname',$uplantname));
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
