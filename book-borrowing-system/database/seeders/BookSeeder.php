<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'judul' => 'No Longer Human',
                'penulis' => 'Osamu Dazai',
                'penerbit' => 'New Directions',
                'tahun_terbit' => 1948,
                'stok' => 3,
                'rfid_tag' => 'NLH001'
            ],
            [
                'judul' => 'Demian',
                'penulis' => 'Hermann Hesse',
                'penerbit' => 'Fischer Verlag',
                'tahun_terbit' => 1919,
                'stok' => 2,
                'rfid_tag' => 'DMN001'
            ],
            [
                'judul' => 'The Moon Over the Mountain',
                'penulis' => 'Atsushi Nakajima',
                'penerbit' => 'Tuttle Publishing',
                'tahun_terbit' => 1942,
                'stok' => 2,
                'rfid_tag' => 'MOM001'
            ],
            [
                'judul' => 'The Metamorphosis',
                'penulis' => 'Franz Kafka',
                'penerbit' => 'Kurt Wolff',
                'tahun_terbit' => 1915,
                'stok' => 4,
                'rfid_tag' => 'MTM001'
            ],
            [
                'judul' => 'Strait is the Gate',
                'penulis' => 'André Gide',
                'penerbit' => 'Gallimard',
                'tahun_terbit' => 1909,
                'stok' => 2,
                'rfid_tag' => 'STG001'
            ],
            [
                'judul' => 'First Love',
                'penulis' => 'Ivan Turgenev',
                'penerbit' => 'Penguin Classics',
                'tahun_terbit' => 1860,
                'stok' => 3,
                'rfid_tag' => 'FLV001'
            ],
            [
                'judul' => 'Somokuto',
                'penulis' => 'Santoka Taneda',
                'penerbit' => 'Kodansha',
                'tahun_terbit' => 1940,
                'stok' => 2,
                'rfid_tag' => 'SMK001'
            ],
            [
                'judul' => 'The Miner',
                'penulis' => 'Natsume Soseki',
                'penerbit' => 'Tuttle Publishing',
                'tahun_terbit' => 1908,
                'stok' => 2,
                'rfid_tag' => 'MNR001'
            ],
            [
                'judul' => 'Notes from Underground',
                'penulis' => 'Fyodor Dostoevsky',
                'penerbit' => 'Epoch Journal',
                'tahun_terbit' => 1864,
                'stok' => 3,
                'rfid_tag' => 'NFU001'
            ],
            [
                'judul' => 'The Myth of Sisyphus',
                'penulis' => 'Albert Camus',
                'penerbit' => 'Gallimard',
                'tahun_terbit' => 1942,
                'stok' => 2,
                'rfid_tag' => 'MOS001'
            ],
            [
                'judul' => 'Frankenstein',
                'penulis' => 'Mary Shelley',
                'penerbit' => 'Lackington & Co',
                'tahun_terbit' => 1818,
                'stok' => 3,
                'rfid_tag' => 'FRK001'
            ],
            [
                'judul' => 'Alice\'s Adventures in Wonderland',
                'penulis' => 'Lewis Carroll',
                'penerbit' => 'Macmillan',
                'tahun_terbit' => 1865,
                'stok' => 4,
                'rfid_tag' => 'AAW001'
            ],
            [
                'judul' => 'The Little Prince',
                'penulis' => 'Antoine de Saint-Exupéry',
                'penerbit' => 'Reynal & Hitchcock',
                'tahun_terbit' => 1943,
                'stok' => 5,
                'rfid_tag' => 'TLP001'
            ],
            [
                'judul' => 'The Works of Edgar Allan Poe',
                'penulis' => 'Edgar Allan Poe',
                'penerbit' => 'Harper & Brothers',
                'tahun_terbit' => 1850,
                'stok' => 2,
                'rfid_tag' => 'EAP001'
            ],
            [
                'judul' => 'Dogra Magra',
                'penulis' => 'Yumeno Kyusaku',
                'penerbit' => 'Shincho Publishing',
                'tahun_terbit' => 1935,
                'stok' => 2,
                'rfid_tag' => 'DGM001'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}