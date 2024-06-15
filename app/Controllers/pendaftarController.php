<?php


class pendaftarController
{
    public function index()
    {
        $models = new pendaftarModel();

        $data = $models->getPendaftar();

        include __DIR__ . '/../Views/others/page_pendaftar.php';
    }
}
