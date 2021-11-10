import 'play.dart';

class Player {
  final String _id;
  final String id;
  final String name;
  final List<Play> play;

  const Player(this._id, this.id, this.name, this.play);

  Player.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        id = json['id'],
        name = json['name'],
        play = (json['play'] as List).map((e) => Play.fromJson(e)).toList();
}
