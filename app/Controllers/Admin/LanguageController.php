<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LanguageModel;

class LanguageController extends BaseController
{
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
            'name' => 'required|min_length[2]',
            'code' => "required|min_length[2]|is_unique[languages.code,id,{$id}]",
        ];

        if (!$validation->setRules($rules)->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $langModel->update($id, [
            'name' => $request->getPost('name'),
            'code' => $request->getPost('code'),
        ]);

        return redirect()->to('/admin/language/index')->with('success', 'Language updated successfully');
    }
}
