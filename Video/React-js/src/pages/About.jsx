import Card from './Card';
import Button from './Button';

function About() {
  const openWebsite = () => {
    window.open('https://www.example.com', '_blank');
  };

  return (
    <div>
      <h1>About SMK Revit</h1>
      
      <Card title="Profil Sekolah" content="SMK Revit adalah sekolah kejuruan yang fokus pada bidang teknologi informasi dan komunikasi.">
        <img 
          src="/images/logo.svg" 
          alt="Logo SMK Revit" 
          style={{ maxWidth: '100px', display: 'block', margin: '10px 0' }} 
        />
      </Card>
      
      <Card title="Visi & Misi" content="Menjadi sekolah kejuruan terdepan dalam menghasilkan lulusan yang kompeten di bidang teknologi.">
        <ul style={{ textAlign: 'left' }}>
          <li>Memberikan pendidikan berkualitas</li>
          <li>Mengembangkan keterampilan praktis</li>
          <li>Membangun karakter siswa</li>
        </ul>
        <Button text="Kunjungi Website" onClick={openWebsite} color="#009688" />
      </Card>
    </div>
  );
}

export default About;