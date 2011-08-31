<?php
	class Model_SearchIndex
	{
		public function updateIndex($type,$id)
		{
			$index = Zend_Search_Lucene::open("/hermes/bosweb/web058/b587/ipg.hiveuserscom/hive/search/".$type);
			$doc = new Zend_Search_Lucene_Document();
			if($type == "gtdata")
			{
				$gtdatamodel = new Model_DbTable_Gtdata();
				$list = $gtdatamodel->getData($id);
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
			}
			else if($type == "forum")
			{
				$forumModel = new Model_DbTable_Forum_Posts();
				$list = $forumModel->getPost($id);
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
				"http://www.hiveusers.com/forums/viewtopic.php?f=" .$list['forum_id'] ."&t=".$list['post_id']));
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
			$index->addDocument($doc);  
			$index->commit();  
			$index->optimize();
		}
	}
