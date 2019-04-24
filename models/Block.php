<?php namespace ReaZzon\Gutenberg\Models;

use Model;
use ReaZzon\Gutenberg\Helpers\BlockHelper;
use ReaZzon\Gutenberg\Helpers\EmbedHelper;
use ReaZzon\Gutenberg\Helpers\SlugHelper;

/**
 * Block Model
 */
class Block extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'reazzon_gutenberg_blocks';

    /**
     * Updates slug according to title
     */
    public function updateSlug()
    {
        $this->slug = SlugHelper::slugify($this->title['raw']);
    }

    /**
     * Returns the rendered content of the block
     * @return String - The completely rendered content
     */
    public function render()
    {
        return BlockHelper::renderBlocks($this->rendered_content);
    }

    /**
     * Renders the content of the Block object
     * @return String
     */
    public function renderRaw()
    {
        $this->rendered_content = EmbedHelper::renderEmbeds($this->raw_content);
        return $this->rendered_content;
    }

    /**
     * Sets the raw content and performs some initial rendering
     * @param String $html
     */
    public function setContent($content)
    {
        $this->raw_content = $content;
        $this->renderRaw();
    }

    /**
     * Returns a content object similar to WordPress
     * @return Array
     */
    public function getContentAttribute()
    {
        return [
            'raw' => $this->raw_content,
            'rendered' => $this->rendered_content
        ];
    }

    /**
     * Transforms title to wordpress title object
     * @param string $title
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = json_encode(['raw' => $title]);
    }
}
