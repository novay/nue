<?php

namespace Novay\Nue\Layout;

use Closure;
use Novay\Nue\Facades\Nue;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;

class Content implements Renderable
{
    /**
     * Content title.
     *
     * @var string
     */
    protected $title = ' ';

    /**
     * Content description.
     *
     * @var string
     */
    protected $description = ' ';

    /**
     * Page breadcrumb.
     *
     * @var array
     */
    protected $breadcrumb = [];

    /**
     * @var array
     */
    protected $view;

    /**
     * Content constructor.
     *
     * @param Closure|null $callback
     */
    public function __construct(\Closure $callback = null)
    {
        if ($callback instanceof Closure) {
            $callback($this);
        }
    }

    /**
     * Alias of method `title`.
     *
     * @param string $header
     *
     * @return $this
     */
    public function header($header = '')
    {
        return $this->title($header);
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set description of content.
     *
     * @param string $description
     *
     * @return $this
     */
    public function description($description = '')
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set breadcrumb of content.
     *
     * @param array ...$breadcrumb
     *
     * @return $this
     */
    public function breadcrumb(...$breadcrumb)
    {
        $this->validateBreadcrumb($breadcrumb);

        $this->breadcrumb = (array) $breadcrumb;

        return $this;
    }

    /**
     * Validate content breadcrumb.
     *
     * @param array $breadcrumb
     *
     * @throws \Exception
     *
     * @return bool
     */
    protected function validateBreadcrumb(array $breadcrumb)
    {
        foreach ($breadcrumb as $item) {
            if (!is_array($item) || !Arr::has($item, 'text')) {
                throw new  \Exception('Breadcrumb format error!');
            }
        }

        return true;
    }

    /**
     * Render giving view as content body.
     *
     * @param string $view
     * @param array  $data
     *
     * @return $this
     */
    public function view($view, $data = [])
    {
        $this->view = compact('view', 'data');

        return $this;
    }

    /**
     * Build html of content.
     *
     * @return string
     */
    public function build()
    {
        ob_start();

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }

    /**
     * Set success message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withSuccess($title = '', $message = '')
    {
        nue_success($title, $message);

        return $this;
    }

    /**
     * Set error message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withError($title = '', $message = '')
    {
        nue_error($title, $message);

        return $this;
    }

    /**
     * Set warning message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withWarning($title = '', $message = '')
    {
        nue_warning($title, $message);

        return $this;
    }

    /**
     * Set info message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withInfo($title = '', $message = '')
    {
        nue_info($title, $message);

        return $this;
    }

    /**
     * @return array
     */
    protected function getUserData()
    {
        if (!$user = Nue::user()) {
            return [];
        }

        return Arr::only($user->toArray(), ['id', 'username', 'email', 'name', 'avatar']);
    }

    /**
     * Render this content.
     *
     * @return string
     */
    public function render()
    {
        $items = [
            'header'      => $this->title,
            'description' => $this->description,
            'breadcrumb'  => $this->breadcrumb,
            '_content_'   => $this->build(),
            '_view_'      => $this->view,
            '_user_'      => $this->getUserData(),
        ];

        return view('nue::content', $items)->render();
    }
}
