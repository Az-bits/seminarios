import logo from "./logo.svg";
import "./App.css";

function App() {
  const Menu = () => {
    return (
      <nav>
        <button>Ver Web</button>
        <button>Ver pdf</button>
        <button>Descargar PDF</button>
      </nav>
    );
  };
  return (
    <div className="App">
      <Menu />
      <h1>hola</h1>
    </div>
  );
}

export default App;
