import 'dart:ffi';

import 'package:equatable/equatable.dart';
import 'question.dart';
import 'player.dart';

class Room {
  final String idroom;
  final List<Question> data;
  final bool isstart;
  final List<Player> players;
  final String imageUrl;
  final String title;
  final bool ispublic;
  final bool isopen;
  final String desription;

  const Room(this.idroom, this.data, this.isstart, this.players, this.imageUrl,
      this.title, this.ispublic, this.isopen, this.desription);

  Room.fromJson(Map<String, dynamic> json)
      : idroom = json['idroom'],
        data = (json['data'] as List).map((e) => Question.fromJson(e)).toList(),
        isstart = json['isstart'],
        players =
            (json['players'] as List).map((e) => Player.fromJson(e)).toList(),
        imageUrl = json['imageUrl'],
        title = json['title'],
        ispublic = json['ispublic'],
        isopen = json['isopen'],
        desription = json['desription'];
}
