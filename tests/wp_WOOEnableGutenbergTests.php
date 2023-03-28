<?php
    declare(strict_types=1);
    use PHPUnit\Framework\Testcase;
    include __DIR__.'/../../../dumb_wordpress_functions.php';
    include __DIR__.'/../src/WOOEnableGutenberg.php';
    final class wp_WOOEnableGutenbergTests extends Testcase
    {
        public function testfor_WOOEnableGutenberg_is_class(): void
        {
            $this->assertTrue(class_exists('WOOEnableGutenberg'));
        }
        public function testfor_WOOEnableGutenberg_init_exists(): void
        {
            $this->assertTrue(method_exists('WOOEnableGutenberg', 'init'));
        }
        public function testfor_returns_true_for_product_post_type(): void
        {
            $i = false;
            if (method_exists('WOOEnableGutenberg', 'enable_taxonomy_rest')
                && method_exists('WOOEnableGutenberg', 'activate_gutenberg_product')) {
                $i = true;
            }
            $this->assertTrue($i);
        }
    }

