<?php

namespace App\Http\Controllers;


use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class GameController extends Controller
{
    /**
     * Mostrar todas las partidas del usuario logueado.
     */
    public function index()
    {
        $games = Game::where('user_id', Auth::id())->get();

                return response()->json([
            'message' => 'Partidas del usuario',
            'data' => $games
        ],200);
    }


    /**
     * Crear una nueva partida ( con valores iniciales)
     */
    public function store(Request $request)
    {
        $game = Game::create([
            'user_id' => Auth::id(),
            'clicks' => 0,
            'points' => 0,
            'duration' => null,
        ]);

        return response()->json([
            'message' => 'Partida creada',
            'data' => $game
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            return response()->json(['error' => 'No tens permís'], 403);
        }

        return response()->json($game);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //Verificamos si el usuario es el propietario
        if($game->user_id !== Auth::id()){
            return response()->json(['error' => 'No autorizado'], 403);
        }
        $validated = $request->validate([
            'clicks' => 'required|integer|min:0',
            'points' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $game->update($validated);

        return response()->json([
            'message' => 'Partida finalizada',
            'data' => $game
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $user = Auth::user();

        if($user->id !== $game->user_id && $user->role !== 'admin'){
            return response()->json(['error' => 'No autorizado'], 403);
        }
        $game->delete();

        return response()->json(['message' => 'Partida eliminada'], 200);
    }

    public function ranking()
    {
    $ranking = Game::select('user_id')
        ->selectRaw('MIN(duration) as best_time')
        ->selectRaw('MIN(clicks) as min_clicks')
        ->selectRaw('MAX(points) as max_points')
        ->groupBy('user_id')
        ->orderBy('best_time')
        ->orderBy('min_clicks')
        ->with('user')
        ->take(5)
        ->get();
    return response()->json([
        'message' => 'Top 5 jugadors',
        'data' => $ranking
    ], 200);
    }

    public function getGamesByUserId($id){

        $user = Auth::user();
        if($user->role !== 'admin'){
            return response()->json(['error' => 'Nomas para admins'], 403);
        }
        $game = Game::where('user_id', $id)->get();

        return response()->json([
            'message' => "Partidas del usuario $id",
            'data' => $game
        ]);
    }
    public function getgamesadmin(){
        $user = Auth::user();
        if($user->role !== 'admin'){
            return response()->json(['error' => 'Nomas para admins'], 403);
        }
        $games = Game::all();

        return response()->json([
            'message' => "Todas las partidas",
            'data' => $games
        ]);
    }
}
