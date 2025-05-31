import { useState } from 'react';
import Card from './Card';
import Button from './Button';

import { useState } from 'react';
import Card from './Card';
import Button from './Button';

function Home() {
  const [count, setCount] = useState(0);

  const incrementCount = () => {
    setCount(count + 1);
  };

  return (
    <div>
      <h1>Home SMK Revit</h1>
      <Card title="Selamat Datang" content="Ini adalah halaman utama SMK Revit.">
        <p>Silakan jelajahi website kami untuk informasi lebih lanjut.</p>
        <img src="/images/logo.svg" alt="Logo SMK Revit" style={{ width: '150px', margin: '20px auto', display: 'block' }} />
      </Card>
      <Card title="Counter Demo" content={`Nilai counter saat ini: ${count}`}>
        <Button text="Tambah Nilai" onClick={incrementCount} color="#2196F3" />
        <Button text="Reset" onClick={() => setCount(0)} color="#f44336" />
      </Card>
    </div>
  );
}

export default Home;