// Header Component
function Header() {
  return (
    <header className="bg-green-500 text-white py-4 shadow-md sticky top-0">
      <div className="text-center text-2xl font-bold">Project 2</div>
    </header>
  );
}

// Footer Component
function Footer() {
  return (
    <footer className="bg-gray-300 mt-8 py-4">
      <div className="text-center">Polats Didzis Ozdemirs, 2025</div>
    </footer>
  );
}

// Main Application Component
export default function App() {
  return (
    <>
      <Header />
      <main className="mb-8 px-4 md:container md:mx-auto text-center">
        <h1 className="text-4xl font-bold text-gray-700">Hello, World!</h1>
      </main>
      <Footer />
    </>
  );
}
