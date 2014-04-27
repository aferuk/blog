<?php if (!defined('BASEPATH')) die();
class Blog extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->   benchmark->   mark('code_start');
        $this->load->helper('form');
        $this->load->library('session');
        $this->  load->  library('pagination');
    }

   public function index()
    {
      if ($this->session->userdata('logon') != '') { $data['logged'] = 'Logged'; }
        else { $data['logged'] = 'Not logged'; }

        $config['base_url'] = '/blog/index'; // путь к страницам в пейджере
        $config['total_rows'] = $this->db->count_all('records'); // всего записей
        $config['per_page'] =  10;   // количество записей на странице
        $config['num_links'] = 5;    // количество ссылок в пейджере (точнее N/2)
        $config['uri_segment'] = 3;  // указываем где в URL номер страницы
        $this->pagination->initialize($config);
        $data['pager']=$this->pagination->create_links();

        $from=intval($this->  uri->  segment(3)); // выделяем из URL номер первой записи на странице
        $this->db->limit(10,$from); // устанавливаем количество записей на странице
        $this->db->order_by("id", "desc"); // устанавливаем порядок следования записей
        $data['query']=$this->db->get('records');

      $this->load->view('include/header');
      $this->load->view('blog', $data);
      $this->load->view('include/footer');
    }

    public function comments()
    {
        $id=$this->uri->segment(3); // получаем номер записи блога из URL
        //(то что после третьего слэша)
        // подробнее о классе URI можно посмотреть в мануале
        $this->db->where('id',$id); // определяем условие выборки текущей записи
        // подробнее о реализации интерфейса к БД можно почитать в мануале
        $query=$this->db->get('records'); // получам основную запись
        $records = $query->result();

        $this->db->where('record_id',$id); // определяем условие выборки комментариев
        $query=$this->db->get('comments'); // получам комментарии из БД
        $comments = $query->result();

        // в отличие от предыдущего контроллера здесь во вьюер передается массив данных.
        $this->load->view('include/header');
        $this->load->view('comment_view', array('records' =>$records, 'comments' =>$comments));
        $this->load->view('include/footer');
    }

    function comment_add()
    {
        $this-> db-> insert('comments',$_POST);
        //!!! insert беззащитен от всякой фигни
        redirect('blog/comments/'.$_POST['record_id']);
        // редирект на исходную позицию
    }
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */