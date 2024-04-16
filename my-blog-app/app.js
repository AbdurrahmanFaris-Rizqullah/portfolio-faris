const express = require('express');
const axios = require('axios');
const dotenv = require('dotenv');
const app = express();

// Menggunakan dotenv untuk mengelola variabel lingkungan
dotenv.config();

// Menggunakan middleware untuk mengizinkan penggunaan file statis
app.use(express.static('public'));

// Rute untuk mengambil data dari WordPress API
app.get('/wordpress-post', async (req, res) => {
    try {
        // Mengambil data dari WordPress API
        const response = await axios.get(process.env.WORDPRESS_API_URL);
        const postData = response.data;

        // Mengambil konten dan gambar postingan dari respons API
        const postContent = postData.content.rendered;
        const postImage = postData.featured_media;

        // Mengirimkan HTML yang berisi konten dan gambar ke klien
        const htmlResponse = `
            <div>
                <img src="${postImage}" alt="Featured Image">
                <div>${postContent}</div>
            </div>
        `;
        res.send(htmlResponse);
    } catch (error) {
        console.error('Error fetching data:', error);
        res.status(500).send('Error fetching data');
    }
});

// Port untuk server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});



$(document).ready(function() {
    // Fungsi untuk menambah blog
    function addBlog() {
        $.ajax({
            url: '/wordpress-post', // Rute yang digunakan untuk mengambil data dari server
            type: 'GET',
            success: function(response) {
                $('#wordpress-posts').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching WordPress posts:', error);
                $('#wordpress-posts').html('Error fetching WordPress posts');
            }
        });
    }

    // Event click untuk tombol Create New Blog
    $('#create-new-blog').click(function(e) {
        e.preventDefault(); // Menghentikan default behavior dari link
        window.location.href = 'add-post.html'; // Mengarahkan ke halaman add-post.html saat tombol diklik
    });

    // Panggil fungsi addBlog() saat halaman siap
    addBlog();
});

// Endpoint untuk menambahkan postingan
app.post('/add-post', (req, res) => {
    const { title, imageUrl, createdAt } = req.body;
    // Proses penyimpanan data ke dalam struktur data yang sesuai dengan kebutuhan Anda
    // Misalnya, simpan data ke dalam database atau struktur data lainnya
    // Setelah berhasil disimpan, Anda dapat mengirimkan respons yang sesuai
    res.status(200).send('Postingan berhasil ditambahkan');
});

