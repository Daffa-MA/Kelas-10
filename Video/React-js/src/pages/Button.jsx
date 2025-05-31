function Button(props) {
  const buttonStyle = {
    backgroundColor: props.color || '#4CAF50',
    border: 'none',
    color: 'white',
    padding: '10px 20px',
    textAlign: 'center',
    textDecoration: 'none',
    display: 'inline-block',
    fontSize: '16px',
    margin: '4px 2px',
    cursor: 'pointer',
    borderRadius: '4px',
    transition: 'background-color 0.3s'
  };

  return (
    <button 
      style={buttonStyle} 
      onClick={props.onClick}
      disabled={props.disabled}
    >
      {props.text || 'Click Me'}
    </button>
  );
}

export default Button;