<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LanguageModel;
use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LanguageController extends BaseController
{
    public function getLangKeywords()
    {
        $keywords = [];
        $path = ROOTPATH; // full project root
        $iterator = new RecursiveIteratorIterator(
            new RecursiveCallbackFilterIterator(
                new RecursiveDirectoryIterator($path),
                function ($fileInfo, $key, $iterator) {
                    $excluded = ['vendor', 'writable'];
                    foreach ($excluded as $folder) {
                        if (strpos($fileInfo->getPathname(), DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR) !== false) {
                            return false;
                        }
                    }
                    return true;
                }
            )
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && in_array($file->getExtension(), ['php', 'html'])) {
                $content = file_get_contents($file->getPathname());

                preg_match_all("/lang\s*\(\s*['\"]([A-Za-z0-9_.]+)['\"]\s*\)/", $content, $matches);
                if (!empty($matches[1])) {
                    foreach ($matches[1] as $match) {
                        $keywords[] = $match;
                    }
                }
            }
        }

        // Remove duplicates & reindex
        $keywords = array_values(array_unique($keywords));

        return $this->response->setJSON([
            'keywords' => $keywords
        ]);
    }

    public function index()
    {
        $title = 'Languages';

        $languageModel = new LanguageModel();

        $languages = $languageModel->findAll();

        return view("admin/language/index", compact("title", "languages"));
    }

    public function store()
    {
        $request = service('request');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[2]',
            'code' => 'required|min_length[2]|is_unique[languages.code]',
        ]);

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $langModel = new LanguageModel();

        $langModel->insert([
            'name' => $request->getPost('name'),
            'code' => $request->getPost('code'),
        ]);

        $languageFolder = APPPATH . 'Language/' . $request->getPost('code');
        if (!is_dir($languageFolder)) {
            mkdir($languageFolder, 0755, true);
        }

        $labelsFile = $languageFolder . '/Labels.php';
        if (!file_exists($labelsFile)) {
            $defaultContent = "<?php\n\nreturn [\n    'welcome' => 'Welcome',\n];\n";
            file_put_contents($labelsFile, $defaultContent);
        }

        return redirect()->to('/admin/language/index')->with('success', 'Language created successfully!');
    }

    public function update($id)
    {
        $langModel = new LanguageModel();
        $language = $langModel->find($id);

        if (!$language) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Language not found");
        }

        $request = service('request');

        $validation = \Config\Services::validation();

        $rules = [
            'name'  => 'required|min_length[2]',
            'code'  => "required|min_length[2]|is_unique[languages.code,id,{$id}]",
            'image' => 'if_exist|uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$validation->setRules($rules)->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'name' => $request->getPost('name'),
            'code' => $request->getPost('code'),
        ];
        
        $image = $request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads/languages', $newName);
            $updateData['image'] = $newName;
            
            if (!empty($language['image']) && file_exists(WRITEPATH . 'uploads/languages/' . $language['image'])) {
                unlink(WRITEPATH . 'uploads/languages/' . $language['image']);
            }
        }

        $langModel->update($id, $updateData);

        return redirect()->to('/admin/language/index')->with('success', 'Language updated successfully');
    }
}
