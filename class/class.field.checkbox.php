<?php
  ////////////////////////////////////////////////////////////
  // 2005-2008 (C) �������� �.�., �������� �.�.
  // PHP. �������� �������� Web-������
  // IT-������ SoftTime 
  // http://www.softtime.ru   - ������ �� Web-����������������
  // http://www.softtime.biz  - ������������ ������
  // http://www.softtime.mobi - ��������� �������
  // http://www.softtime.org  - �������������� �������
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ 
  // (http://www.softtime.ru/info/articlephp.php?id_article=23)
  error_reporting(E_ALL & ~E_NOTICE);

  ////////////////////////////////////////////////////////////
  // ������ checkbox
  ////////////////////////////////////////////////////////////

  class field_checkbox extends field
  {
    // ����������� ������
    function __construct($name, 
                   $caption, 
                   $value = false,
                   $parameters = "", 
                   $help = "",
                   $help_url = "")
    {
      // �������� ����������� �������� ������ field ��� 
      // ������������� ��� ������
      parent::__construct($name, 
                   "checkbox", 
                   $caption, 
                   false, 
                   $value,
                   $parameters, 
                   $help,
                   $help_url);
      // �������������� ����� ������
      if($value == "on") $this->value = true;
      else if($value === true) $this->value = true;
      else $this->value = false;
    }

    // �����, ��� �������� ����� �������� ����
    // � ������ ���� �������� ����������
    function get_html()
    {
      // ���� �������� ���������� �� ����� - ��������� ��
      if(!empty($this->css_style))
      {
        $style = "style=\"".$this->css_style."\"";
      }
      else $style = "";
      if(!empty($this->css_class))
      {
         $class = "class=\"".$this->css_class."\"";
      }
      else $class = "";
      
      // ��������� ������� �� ������
      if($this->value) $checked = "checked";
      else $checked = "";

      // ��������� ���
      $tag = "<input $style $class
                     type=\"".$this->type."\" 
                     name=\"".$this->name."\" 
                     $checked>\n";

      // ��������� ���������, ���� ��� �������
      $help = "";
      if(!empty($this->help))
      {
        $help .= "<span style='color:blue'>".
                    nl2br($this->help)
                 ."</span>";
      }
      if(!empty($help)) $help .= "<br>";
      if(!empty($this->help_url))
      {
        $help .= "<span style='color:blue'>
                    <a href=".$this->help_url.">������</a>
                  </span>";
      }

      return array($this->caption, $tag, $help);
    }

    // �����, ����������� ������������ ���������� ������
    function check()
    {
      return "";
    }
  }
?>