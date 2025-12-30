<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class View extends Command
{
    protected $signature = 'make:view {type} {name}';
    protected $description = 'Create a Blade view or Atomic Design component';

    public function handle()
    {
        $type = strtolower($this->argument('type'));
        $name = Str::kebab($this->argument('name'));

        $validTypes = ['atom', 'molecule', 'organism', 'template', 'page'];

        if (!in_array($type, $validTypes)) {
            $this->error("Invalid type. Allowed: atom, molecule, organism, template, page");
            return;
        }

        if ($type === 'page') {
            return $this->createPage($name);
        }

        return $this->createComponent($type, $name);
    }

    private function createComponent(string $type, string $name)
    {
        $folder = match ($type) {
            'atom' => 'atoms',
            'molecule' => 'molecules',
            'organism' => 'organisms',
            'template' => 'templates',
        };

        $path = resource_path("views/components/$folder/$name.blade.php");

        if (file_exists($path)) {
            $this->error("Component already exists: $path");
            return;
        }

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, "<div>\n    <!-- $folder: $name component -->\n</div>");

        $this->info("Created component: resources/views/components/$folder/$name.blade.php");
    }

    private function createPage(string $name)
    {
        $path = resource_path("views/$name.blade.php");

        if (file_exists($path)) {
            $this->error("Page already exists: $path");
            return;
        }

        // 👉 Page is completely empty now
        file_put_contents($path, "");

        $this->info("Created page: resources/views/$name.blade.php");
    }
}
