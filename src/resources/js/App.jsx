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

// Mock Data
const topBooks = [
  { "id": 1, "name": "test", "description": null, "author": "TEST2", "genre": "Action", "price": "15.00", "year": 950, "image": "http://localhost/images/679bb24c8bb2f.jpg" },
  { "id": 2, "name": "Les Miserables", "description": "adsdfdadf", "author": "test2", "genre": "Action", "price": "13.00", "year": 153, "image": "http://localhost/images/679bd495152d3.jpg" }
];

const selectedBook = {
  "id": 2,
  "name": "Les Miserables",
  "description": "adsdfdadf",
  "author": "test2",
  "genre": "Action",
  "price": "13.00",
  "year": 153,
  "image": "http://localhost/images/679bd495152d3.jpg"
};

const relatedBooks = [
  { "id": 3, "name": "test4", "description": "hocus pocus", "author": "test2", "genre": "Action", "price": "17.00", "year": 2020, "image": null },
  { "id": 1, "name": "test", "description": null, "author": "TEST2", "genre": "Action", "price": "15.00", "year": 950, "image": "http://localhost/images/679bb24c8bb2f.jpg" }
];

// Homepage Component
function Homepage({ handleBookSelection }) {
  return (
    <>
      {topBooks.map((book, index) => (
        <TopBookView
          book={book}
          key={book.id}
          index={index}
          handleBookSelection={handleBookSelection}
        />
      ))}
    </>
  );
}

// Top Book View Component
function TopBookView({ book, index, handleBookSelection }) {
  return (
    <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
      <div className={`order-2 px-12 md:basis-1/2 ${index % 2 === 1 ? "md:order-1 md:text-right" : ""}`}>
        <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">{book.name}</p>
        <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4">
          {(book.description ? book.description.split(" ").slice(0, 16).join(" ") : "No description") + '...'}
        </p>
        <SeeMoreBtn bookID={book.id} handleBookSelection={handleBookSelection} />
      </div>
      <div className={`order-1 md:basis-1/2 ${index % 2 === 1 ? "md:order-2" : ""}`}>
        <img
          src={book.image || "https://via.placeholder.com/150"}
          alt={book.name}
          className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto"
        />
      </div>
    </div>
  );
}

// See More Button Component
function SeeMoreBtn({ bookID, handleBookSelection }) {
  return (
    <button
      className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bg-sky-400 text-sky-50 cursor-pointer"
      onClick={() => handleBookSelection(bookID)}
    >
      See more
    </button>
  );
}

// Main Application Component
export default function App() {
  // Function to store Book ID in state
  function handleBookSelection(bookID) {
    alert("Selected ID " + bookID);
  }

  return (
    <>
      <Header />
      <main className="mb-8 px-2 md:container md:mx-auto">
        <Homepage handleBookSelection={handleBookSelection} />
      </main>
      <Footer />
    </>
  );
}
