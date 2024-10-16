<?php namespace fortrabbit\Yii2ArtisanBridge\base;

use fortrabbit\Yii2ArtisanBridge\ConsoleOutput;
use fortrabbit\Yii2ArtisanBridge\OutputStyle;
use Symfony\Component\Console\Input\ArgvInput;
use yii\base\Action as YiiBaseAction;

/**
 * Class Action
 *
 * @package fortrabbit\Yii2ArtisanBridge\base
 *
 */
abstract class Action extends YiiBaseAction
{
    /**
     * @var \fortrabbit\Yii2ArtisanBridge\OutputStyle
     */

    protected $output;

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * @var bool whether to run the command interactively.
     */
    public $interactive = true;

    /**
     * @var bool whether to display help information about current command.
     */
    public $help;


    use ArtisanOutputTrait;
    use BlockOutputTrait;

    /**
     * Action constructor.
     *
     * @param string               $id
     * @param \fortrabbit\Yii2ArtisanBridge\base\Commands $controller
     * @param array                $config
     */
    public function __construct(string $id, Commands $controller, array $config = [])
    {
        parent::__construct($id, $controller, $config);

        $this->input = new ArgvInput();
        $this->input->setInteractive($controller->interactive);
        $this->output = new OutputStyle($this->input, new ConsoleOutput());
        
    }

}

