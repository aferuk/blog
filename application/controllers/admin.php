<?php if (!defined('BASEPATH')) die();
class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        // подключаем библиотеку поддержки сессий
        $this->load->library('session');
        // проверяем наличие принака залогинивания в сессии
        // если залогинились - выполняем вызванную функцию
        if ($this->session->userdata('logon') != '') return;
        // переход к обработке логина
        if ($this->uri->segment(2)==='login') return;
        // редирект на логин, если залогинивания не было
        redirect('admin/login');
    }

   public function index()
    {
        $data['query']=$this->db->get('records');

      $this->load->view('include/header');
      $this->load->view('blog', $data);
      $this->load->view('include/footer');
    }

    function record_add()
    {
        if (isset($_POST)) if (isset($_POST['title']))
            // проверяем были ли отосланы данные формы
        {
            $this-> db-> insert('records',$_POST);
            // если данные были приняты - записываем их в БД
            redirect('blog');  //  редирект в начало
        } else
        {
            // если данных нет - выводим форму для добавления новой записи в блог
            $this->load->view('include/header');
            $this->load->view('record_add');
            $this->load->view('include/footer');
        }
    }

    function login()
    {
        if (isset($_POST['password'])) // проверяем был ли прислан пароль
        // проверяем корректность пароля и логина
        // Ахтунг! В реальном скрипте пароль в явном виде не должен присутствовать.
        if ($_POST['password']==='123')
            if ($_POST['login']==='admin')
            {
                $session_data = array('logon' =>      'Yes!'); // записываем в сессию признак логона
                $this->session->set_userdata($session_data);
                redirect(''); // редирект на главную страницу
            }


        $this->load->view('include/header');
        $this->load->view('login');
        $this->load->view('include/footer');
    }

    function logoff()
    {
        $this->session->sess_destroy();  // обнуляем сессию
        redirect(''); // редирект на главную страницу
    }

    function record_add_test()  /* Заполнение тестовыми записями*/
    {
        for ($i=1;$i<50;$i++)
            $this->  db->  insert('records',array('title'=>  'TITLE #'.$i,'body'=>  '#'.$i.' Lorem ipsum dolor'));
        for ($i=1;$i<50;$i++)
            $this->  db->  insert('comments',array('record_id'=>  1,'author'=>  'NAME #'.$i,'body'=>  '#'.$i.'quis autem'));
        redirect('');  //  редирект в начало
    }
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */