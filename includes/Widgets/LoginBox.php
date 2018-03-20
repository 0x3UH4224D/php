<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Container.php";
require_once "./includes/Widgets/Form.php";
require_once "./includes/Widgets/Link.php";
require_once "./includes/Widgets/Text.php";
require_once "./includes/Widgets/Input.php";
require_once "./includes/Widgets/Separator.php";
require_once "./includes/Widgets/Label.php";
require_once "./includes/Widgets/Button.php";

use \CTG\Widgets\Container;
use \CTG\Widgets\Form;
use \CTG\Widgets\Link;
use \CTG\Widgets\Text;
use \CTG\Widgets\Input;
use \CTG\Widgets\Separator;
use \CTG\Widgets\Label;
use \CTG\Widgets\Button;

class LoginBox extends Container {
    function __construct($prefix = '') {
        parent::__construct('div');
        $this->setClass('container');

        $username_group = new Container('div');
        $username_group->setClass('form-group');

        $username_label = new Label('اسم المستخدم', $prefix . 'username');
        $username_input = Input::Text($prefix . 'username', 'أدخل اسم المستخدم', true);
        $username_input->setClass('form-control');
        $username_input->setId($prefix . 'username');
        $username_group->adds($username_label, $username_input);

        $password_group = new Container('div');
        $password_group->setClass('form-group');

        $password_label = new Label('كلمة السر', $prefix . 'password');
        $password_input = Input::Password($prefix . 'password', 'أدخل كلمة السر', true);
        $password_input->setClass('form-control');
        $password_input->setId($prefix . 'password');
        $password_group->adds($password_label, $password_input);

        $remember_group = new Container('div');
        $remember_group->setClass('form-group');

        $remember_label = new Label('تذكرني', $prefix . 'remember');
        $remember_label->setClass('form-check-label');
        $remember_input = Input::Checkbox($prefix . 'remember', 'remember_me', true);
        $remember_input->setClass('form-check-input');
        $remember_input->setId($prefix . 'remember');
        $remember_group->adds($remember_input, $remember_label);

        $forgot_pass = new Link('نسيت كلمة السر', 'forget-password/');
        $forgot_pass->setClass('form-text text-muted small');

        $submit_btn = Button::Submit('لِج');
        $submit_btn->setClass('btn btn-primary');

        $form = new Form();
        $form->adds(
            $username_group,
            $password_group,
            $remember_group,
            $forgot_pass,
            $submit_btn
        );

        $this->add($form);
    }
}
