import { loginUser } from "@/Hooks/auth";
import { useState, FormEvent } from "react";
import { FiEye, FiEyeOff } from "react-icons/fi";

const Login = () => {
  const [ email, setEmail ] = useState<string>("");
  const [ password, setPassword ] = useState<string>("");
  const [ error, setError ] = useState<string>("");
  const [ loading, setLoading ] = useState<boolean>(false);
  const handleSubmit = async(e: FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError("");

    if( !email && !password ) {
      setError("Email Dan Password Harus Di Isi!");
      setLoading(false);
      return;
    }
    else if(!email) {
      setError("Email Harus Di isi!");
      setLoading(false);
      return;
    }
    else if(!password) {
      setError("Password Harus Di isi!");
      setLoading(false);
      return;
    }

    try {
      const data = await loginUser({email, password});
      setError(data);
    } catch(error: any) {
      setError("Kesalahan Tidak Terduga")
    } finally {
      setLoading(false);
    }
  }

  const [passwordVisible, setPasswordVisible] = useState<boolean>(false);
  const togglePasswordVisibility = () => {
    setPasswordVisible((prev) => !prev);
  };

  return (
    <div className="w-full h-screen bg-white backdrop-blur-sm flex items-center justify-center">
      <form
        onSubmit={handleSubmit}
        className="bg-white w-3/6 h-96 rounded-3xl border border-gray-300 flex shadow-xl relative"
      >
        <div className="text-4xl">
          <button
            type="button"
            className="absolute top-4 right-4 text-gray-600"
            onClick={() => window.location.href="/"}
          >
            &times;
          </button>
        </div>

        <div className="w-1/2 h-full overflow-hidden flex justify-center items-center">
          <a href="/" id="logo" className="flex space-x-3 items-center absolute p-5">
            <img
              className="w-12"
              src="https://i.ibb.co.com/0DhSzYN/Yhoiki.png"
              alt="logo"
            />
            <h1 className="text-gray-700 font-bold text-4xl">Yhoiki</h1>
          </a>
        </div>

        <div className="w-1/2 flex flex-col space-y-4 p-8 justify-center items-center text-gray-600">
          <h1 className="text-2xl font-bold text-gray-600">Login</h1>

          <input
            type="email"
            name="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="Email"
            className="bg-gray-200 rounded-full px-6 py-2 border border-gray-300 hover:bg-gray-300 outline-color1 duration-300 w-full"
          />

          <div className="w-full relative">
            <input
              type={passwordVisible ? "text" : "password"}
              placeholder="Password"
              name="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="bg-gray-200 rounded-full px-6 py-2 border border-gray-300 hover:bg-gray-300 outline-color1 duration-300 w-full"
            />
            <button
              type="button"
              className="absolute right-4 top-1/2 transform -translate-y-1/2"
              onClick={togglePasswordVisibility}
            >
              {passwordVisible ? (
                <FiEyeOff className="text-gray-400" size={20} />
              ) : (
                <FiEye className="text-gray-400" size={20} />
              )}
            </button>
          </div>
          {error && (
            <p className="text-red-500 text-xs">{error}</p>
          )}

          <button
            type="submit"
            disabled={loading}
            className="bg-gradient-to-r from-color1 to-color2 text-white w-full rounded-full p-2 hover:from-color2 hover:to-color2 duration-300"
          >
            {loading ? "Logging in..." : "Login"}
          </button>
        </div>
      </form>
    </div>
  );
};

export default Login;
