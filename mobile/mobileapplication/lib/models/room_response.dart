import 'room.dart';

class Room_Response {
  final String message;
  final Room doc;

  Room_Response(this.message, this.doc);

  Room_Response.fromJson(Map<String, dynamic> json)
      : message = json['message'],
        doc = Room.fromJson(json['doc']);
}
