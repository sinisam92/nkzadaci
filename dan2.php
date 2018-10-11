<?php

echo 'Singletoon pattertn <br>';

class Counter {
    private static $instance;
    private $count;

    private function __construct() {
        $this->count = 0;
    }

    static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Counter();
        }

        return self::$instance;
    }

    public function incrementCount() {
        $this->count++;
    }

    public function getCount() {
        return $this->count;
    }
}
echo Counter::getInstance()->getCount(); // 0
Counter::getInstance()->incrementCount();
Counter::getInstance()->incrementCount();
Counter::getInstance()->incrementCount();
echo Counter::getInstance()->getCount() . "<br>"; // 3








abstract class Button
{
    abstract public function render();
}

abstract class TextArea
{
    abstract public function render();
}

class WindowsButton extends Button
{
    public function render()
    {
        echo 'Windows Button <br>';
    }
}

class MacOSButton extends Button
{
    public function render()
    {
        echo 'macOS Button <br>';
    }
}

class LinuxButton extends Button
{
    public function render()
    {
        echo 'Linux Button <br>';
    }
}

class WindowsTextArea extends TextArea
{
    public function render()
    {
        echo 'Windows Text Area <br>';
    }
}

class MacOSTextArea extends TextArea
{
    public function render()
    {
        echo 'MacOS Text Area <br>';
    }
}

class LinuxTextArea extends TextArea
{
    public function render()
    {
        echo 'Linux Text Area <br>';
    }
}

abstract class Theme
{
    abstract public function makeButton(): Button;

    abstract public function makeTextArea(): TextArea;
}

// windows factory koja nasledjuje abstraktnu klasu Theme
// i implementira metode makeButton i makeTextArea
class WindowsTheme extends Theme
{
    public function makeButton(): Button
    {
        return new WindowsButton();
    }

    public function makeTextArea(): TextArea
    {
        return new WindowsTextArea();
    }
}

// mac os factory koja nasledjuje abstraktnu klasu Theme
// i implementira metode makeButton i makeTextArea
class MacOSTheme extends Theme
{
    public function makeButton(): Button
    {
        return new MacOSButton();
    }

    public function makeTextArea(): TextArea
    {
        return new MacOSTextArea();
    }
}

// linux factory koja nasledjuje abstraktnu klasu Theme
// i implementira metode makeButton i makeTextArea
class LinuxTheme extends Theme
{
    public function makeButton(): Button
    {
        return new LinuxButton();
    }

    public function makeTextArea(): TextArea
    {
        return new LinuxTextArea();
    }
}

class Application
{
    private $theme;

    /**
     * Promena teme
     *
     * @param Theme $theme Konkretna tema (Windows, Linux ili MacOs)
     * @return void
     */
    public function changeTheme(Theme $theme)
    {
        $this->theme = new $theme;
    }

    /**
     * Prikaz modala u zavisnosti od teme
     * Tema moze bili Windows, Mac ili Linux
     *
     * @return void
     */
    public function showModal()
    {
        // kreiranje objekta button u zavisnosti od teme i renderovanje
        $this->theme->makeButton()->render();

        // kreiranje objekta text area u zavisnosti od teme i renderovanje
        $this->theme->makeTextArea()->render();
    }
}

$app = new Application();

$app->changeTheme(new WindowsTheme);
$app->showModal();

$app->changeTheme(new LinuxTheme);
$app->showModal();

$app->changeTheme(new MacOSTheme);
$app->showModal();





class News
{
    private $subscribers;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->subscribers = [];
    }

    public function getName()
    {
        return $this->name;
    }

    public function registerSubscriber($subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public function notifySubscribers($message)
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->notify($this, $message);
        }
    }
}

class Subscriber
{
    public function notify($news, $message)
    {
        echo 'Got message: ' . $message
            . ', from ' . $news->getName() . '.<br>';
    }
}

$blic = new News('Blic');
$politika = new News('Politika');

$milan = new Subscriber();
$marko = new Subscriber();
$ana = new Subscriber();

$blic->registerSubscriber($milan);
$blic->registerSubscriber($marko);
$politika->registerSubscriber($ana);

$blic->notifySubscribers('Otvoren je Lidl!');
$politika->notifySubscribers('Piletina 120din u Lidl!');