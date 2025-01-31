import { useEffect, useState } from "react";
import '../css/loader.css';

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

// Loader Component
function Loader() {
    return (
        <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
            <div className="loader"></div>
        </div>
    );
}

// Error Message Component
function ErrorMessage({ msg }) {
    return (
        <div className="md:container md:mx-auto bg-red-300 my-8 p-2">
            <p className="text-black">{msg}</p>
        </div>
    );
}

export default function App() {
    const [selectedBookID, setSelectedBookID] = useState(null);

    function handleBookSelection(bookID) {
        setSelectedBookID(bookID);
    }

    function handleGoingBack() {
        setSelectedBookID(null);
    }

    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                {selectedBookID ? (
                    <BookPage selectedBookID={selectedBookID} handleGoingBack={handleGoingBack} />
                ) : (
                    <Homepage handleBookSelection={handleBookSelection} />
                )}
            </main>
            <Footer />
        </>
    );
}

// Homepage Component - Loads top books from API
function Homepage({ handleBookSelection }) {
    const [topBooks, setTopBooks] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchTopBooks() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch('http://localhost/data/get-top-books');
                if (!response.ok) throw new Error("Error while loading data. Please reload page!");
                
                const data = await response.json();
                setTopBooks(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        fetchTopBooks();
    }, []);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && topBooks.map((book, index) => (
                <TopBookView 
                    key={book.id} 
                    book={book} 
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
                <p className="mb-4 text-3xl font-light text-neutral-900">{book.name}</p>
                <p className="mb-4 text-xl font-light text-neutral-900">
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

// Book Page Component
function BookPage({ selectedBookID, handleGoingBack }) {
    return <SelectedBookView selectedBookID={selectedBookID} handleGoingBack={handleGoingBack} />;
}

// Selected Book View - Displays book details
function SelectedBookView({ selectedBookID, handleGoingBack }) {
    const [selectedBook, setSelectedBook] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchSelectedBook() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch(`http://localhost/data/get-book/${selectedBookID}`);
                if (!response.ok) throw new Error("Error while loading data. Please reload page!");
                
                const data = await response.json();
                setSelectedBook(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        if (selectedBookID) fetchSelectedBook();
    }, [selectedBookID]);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && selectedBook.name && (
                <>
                    <div className="rounded-lg flex flex-wrap md:flex-row">
                        <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                            <h1 className="text-3xl font-light text-neutral-900">{selectedBook.name}</h1>
                        </div>
                    </div>
                    <div className="mb-12 flex flex-wrap">
                        <GoBackBtn handleGoingBack={handleGoingBack} />
                    </div>
                </>
            )}
        </>
    );
}

// Go Back Button Component
function GoBackBtn({ handleGoingBack }) {
    return (
        <button 
            className="inline-block rounded-full py-2 px-4 bg-neutral-500 hover:bg-neutral-400 text-neutral-50 cursor-pointer" 
            onClick={handleGoingBack}
        >
            Back
        </button>
    );
}
