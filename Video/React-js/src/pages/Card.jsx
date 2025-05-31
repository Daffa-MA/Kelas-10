function Card(props) {
  return (
    <div className="card-container" style={{
      border: '1px solid #ccc',
      borderRadius: '8px',
      padding: '16px',
      margin: '16px 0',
      boxShadow: '0 4px 8px rgba(0,0,0,0.1)',
      backgroundColor: '#fff'
    }}>
      <h2 style={{ color: '#333', marginBottom: '8px' }}>{props.title}</h2>
      <p style={{ color: '#666' }}>{props.content}</p>
      {props.children}
    </div>
  );
}

export default Card;