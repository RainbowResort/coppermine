<?php
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
class search_controller extends Controller {
    function search_controller() {
        parent::Controller();
    }
    function index() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $messages = array();
        // to-do: search through messages
        if ($this->validate->get->keyExists('search') && $this->validate->get->getRaw('search')) {
            $vars['search'] = $search = $this->validate->get->getRaw('search');
            $search = trim($search);
            if (!$search) break;
            $search = preg_replace('/\s+/', ' ', $search);
            $vars['paging'] = array();
            $vars['paging']['total']   = $vars['results'] = $this->forum->get_search_result_count($search);
            $vars['paging']['pattern'] = 'forum.php?c=search&search='.$vars['search'].'&submit=1';
            $vars['paging']['start']   = $this->validate->get->getInt('start', 0);
            $vars['paging']['limit']   = Config::item('fr_msg_per_page');
            $messages = $this->forum->get_search_result($search, '*', $vars['paging']['start'], $vars['paging']['limit']);
            $vars['messages'] = array();
            foreach ($messages as $message) {
                $newmessage = array();
                $topic = $this->forum->get_topic_data($message['topic_id'],'first_msg_id,replies');
                $first = $this->forum->get_message_data($topic['first_msg_id'],'subject,poster_id,poster_name');
                $newmessage['topic_id'] = $message['topic_id'];
                $newmessage['topic_name'] = $first['subject'];
                $newmessage['id'] = $message['msg_id'];
                $newmessage['name'] = $message['subject'];
                $newmessage['body'] = $message['body'];
                $newmessage['poster_id'] = $message['poster_id'];
                $newmessage['poster_name'] = $message['poster_name'];
                $newmessage['starter_id'] = $first['poster_id'];
                $newmessage['starter_name'] = $first['poster_name'];
                $newmessage['poster_time'] = $message['poster_time'];
                $newmessage['linkto'] = $this->forum->get_nagavitor('message', 'index', $message['msg_id']);
                $vars['messages'][] = $newmessage;
            }
        }
        $this->view->render('search/index', $vars);
    }
    function xxx_topics($xxx) {
        $func_name = 'get_'.$xxx.'_topic';
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['topic_count'] = $this->forum->$func_name('count(*) as count');        
        $vars['paging'] = array();
        $vars['paging']['total']   = $vars['topic_count'];
        $vars['paging']['pattern'] = 'forum.php?c=search&m='.$xxx.'_topics';
        $vars['paging']['start']   = $this->validate->get->getInt('start', 0);
        $vars['paging']['limit']   = Config::item('fr_topic_per_page');        
        $topics = $this->forum->$func_name('*', $vars['paging']['start'], $vars['paging']['limit']);
        $vars['topics'] = array();        
        foreach ($topics as $topic) {                
            $newtopic = array();                        
            $first_message = $this->forum->get_message_data($topic['first_msg_id']);
            $last_message  = $this->forum->get_message_data($topic['last_msg_id']);        
            $message_count = $this->forum->get_message_count($topic['topic_id']);            
            if ($topic['locked']) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_readonly.gif';            
            } else if ($topic['is_sticky']) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_reply.gif';            
            } else if ($number_of_msg >= Config::item('fr_hot_topic_msg')) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_hot.gif';
            } else {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_new.gif';
                //"plugins/forum/forum/html/images/default/icon_topic.gif";
            }            
            $newtopic['icon']                  = 'plugins/forum/forum/html/images/post/'.$first_message['icon'].'.gif';            
            $newtopic['id']                    = $topic['topic_id'];
            $newtopic['name']                    = $first_message['subject'];            
            $newtopic['starter_id']            = $first_message['poster_id'];
            $newtopic['starter_name']            = $first_message['poster_name'];            
            $newtopic['replies']                = $topic['replies'];
            $newtopic['views']                    = $topic['views'];            
            $newtopic['last_post_id']          = $last_message['msg_id'];
            $newtopic['last_post_title']       = $last_message['subject'];                
            $newtopic['last_post_time']        = $last_message['poster_time'];
            $newtopic['last_post_author_id']   = $last_message['poster_id'];
            $newtopic['last_post_author_name'] = get_username($last_message['poster_id']);            
            $vars['topics'][] = $newtopic;
            unset($newtopic);
        }        
        $this->view->render('search/'.$xxx.'_topics', $vars);
    }
    function new_topics() {
        $this->xxx_topics('new');
    }
    function active_topics() {
        $this->xxx_topics('active'); 
    }
    function pending_topics() {
        $this->xxx_topics('pending');
    }
}