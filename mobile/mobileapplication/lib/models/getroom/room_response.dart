import 'room.dart';

class RoomResponse {
  final String message;
  final Room doc;

  RoomResponse(this.message, this.doc);

  RoomResponse.fromJson(Map<String, dynamic> json)
      : message = json['message'],
        doc = Room.fromJson(json['doc']);
}
