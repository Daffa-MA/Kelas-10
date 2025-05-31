import { useState } from 'react';
import Card from './Card';
import Button from './Button';

function Contact() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  
  const [submitted, setSubmitted] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Form data submitted:', formData);
    setSubmitted(true);
    // Dalam aplikasi nyata, di sini Anda akan mengirim data ke server
  };

  const resetForm = () => {
    setFormData({
      name: '',
      email: '',
      message: ''
    });
    setSubmitted(false);
  };

  return (
    <div>
      <h1>Contact SMK Revit</h1>
      
      <Card title="Informasi Kontak" content="Hubungi kami melalui informasi di bawah ini:">
        <div style={{ marginTop: '10px', textAlign: 'left' }}>
          <p><strong>Alamat:</strong> Jl. Pendidikan No. 123, Kota Revit</p>
          <p><strong>Telepon:</strong> (021) 123-4567</p>
          <p><strong>Email:</strong> info@smkrevit.edu</p>
        </div>
      </Card>
      
      <Card title="Formulir Kontak" content="Silakan isi formulir di bawah ini untuk menghubungi kami:">
        {!submitted ? (
          <form onSubmit={handleSubmit} style={{ textAlign: 'left' }}>
            <div style={{ margin: '10px 0' }}>
              <label style={{ display: 'block', marginBottom: '5px' }}>Nama:</label>
              <input 
                type="text" 
                name="name" 
                value={formData.name} 
                onChange={handleChange} 
                required 
                style={{ 
                  width: '100%', 
                  padding: '8px', 
                  borderRadius: '4px', 
                  border: '1px solid #ccc' 
                }} 
              />
            </div>
            
            <div style={{ margin: '10px 0' }}>
              <label style={{ display: 'block', marginBottom: '5px' }}>Email:</label>
              <input 
                type="email" 
                name="email" 
                value={formData.email} 
                onChange={handleChange} 
                required 
                style={{ 
                  width: '100%', 
                  padding: '8px', 
                  borderRadius: '4px', 
                  border: '1px solid #ccc' 
                }} 
              />
            </div>
            
            <div style={{ margin: '10px 0' }}>
              <label style={{ display: 'block', marginBottom: '5px' }}>Pesan:</label>
              <textarea 
                name="message" 
                value={formData.message} 
                onChange={handleChange} 
                required 
                rows="4" 
                style={{ 
                  width: '100%', 
                  padding: '8px', 
                  borderRadius: '4px', 
                  border: '1px solid #ccc' 
                }} 
              ></textarea>
            </div>
            
            <Button text="Kirim Pesan" color="#4CAF50" />
          </form>
        ) : (
          <div style={{ textAlign: 'center' }}>
            <p style={{ color: 'green', fontWeight: 'bold' }}>Terima kasih! Pesan Anda telah terkirim.</p>
            <Button text="Kirim Pesan Lagi" onClick={resetForm} color="#2196F3" />
          </div>
        )}
      </Card>
    </div>
  );
}

export default Contact;