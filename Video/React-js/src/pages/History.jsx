import Card from './Card';

function History() {
  const timelineEvents = [
    { year: '2010', event: 'Pendirian SMK Revit' },
    { year: '2015', event: 'Pembukaan jurusan Teknologi Informasi' },
    { year: '2018', event: 'Peresmian gedung baru' },
    { year: '2020', event: 'Akreditasi A untuk semua jurusan' },
    { year: '2023', event: 'Peluncuran program kerjasama industri' }
  ];

  return (
    <div>
      <h1>History SMK Revit</h1>
      
      <Card title="Sejarah Singkat" content="SMK Revit didirikan pada tahun 2010 dengan visi menjadi lembaga pendidikan kejuruan terdepan di bidang teknologi.">
        <img 
          src="/images/logo.svg" 
          alt="Logo SMK Revit" 
          style={{ maxWidth: '100px', display: 'block', margin: '10px auto' }} 
        />
      </Card>
      
      <Card title="Timeline Perkembangan" content="Berikut adalah tonggak penting dalam perjalanan SMK Revit:">
        <div style={{ marginTop: '15px' }}>
          {timelineEvents.map((item, index) => (
            <div key={index} style={{ display: 'flex', marginBottom: '10px', alignItems: 'center' }}>
              <div style={{ 
                minWidth: '60px', 
                fontWeight: 'bold', 
                padding: '5px 10px', 
                backgroundColor: '#e0e0e0', 
                borderRadius: '4px',
                marginRight: '10px'
              }}>
                {item.year}
              </div>
              <div>{item.event}</div>
            </div>
          ))}
        </div>
      </Card>
    </div>
  );
}

export default History;