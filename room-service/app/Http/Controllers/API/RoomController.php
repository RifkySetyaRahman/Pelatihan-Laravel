<?php

namespace App\Http\Controllers\API;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

/**
 * @OA\Schema(
 *     schema="Room",
 *     type="object",
 *     required={"name", "capacity"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Ruang Rapat 1"),
 *     @OA\Property(property="capacity", type="integer", example=20),
 *     @OA\Property(property="facilities", type="string", example="Proyektor, AC, Whiteboard"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/rooms",
     *     summary="Ambil daftar semua ruangan",
     *     tags={"Rooms"},
     *     @OA\Response(
     *         response=200,
     *         description="Sukses",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Room"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Room::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     summary="Tambah ruangan baru",
     *     tags={"Rooms"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "capacity"},
     *             @OA\Property(property="name", type="string", example="Ruang Kelas A"),
     *             @OA\Property(property="capacity", type="integer", example=30),
     *             @OA\Property(property="facilities", type="string", example="AC, LCD Projector")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Ruangan berhasil dibuat", @OA\JsonContent(ref="#/components/schemas/Room")),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'capacity' => 'required|integer',
            'facilities' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/rooms/{id}",
     *     summary="Lihat detail ruangan",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ruangan",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Sukses", @OA\JsonContent(ref="#/components/schemas/Room")),
     *     @OA\Response(response=404, description="Ruangan tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        return response()->json($room);
    }

    /**
     * @OA\Put(
     *     path="/api/rooms/{id}",
     *     summary="Update data ruangan",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ruangan",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Ruang Rapat Besar"),
     *             @OA\Property(property="capacity", type="integer", example=50),
     *             @OA\Property(property="facilities", type="string", example="AC, Sound System, Projector")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Sukses", @OA\JsonContent(ref="#/components/schemas/Room")),
     *     @OA\Response(response=404, description="Ruangan tidak ditemukan"),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|unique:room,name,' . $id,
            'capacity' => 'sometimes|required|integer',
            'facilities' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room->update($request->all());
        return response()->json($room);
    }

    /**
     * @OA\Delete(
     *     path="/api/rooms/{id}",
     *     summary="Hapus ruangan",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ruangan",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Ruangan berhasil dihapus"),
     *     @OA\Response(response=404, description="Ruangan tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
