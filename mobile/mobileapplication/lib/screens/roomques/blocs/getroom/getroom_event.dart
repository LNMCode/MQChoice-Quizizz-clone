import 'package:equatable/equatable.dart';
import 'package:flutter/cupertino.dart';

// Get question from api

abstract class GetRoomEvent extends Equatable {
  const GetRoomEvent();

  @override
  List<Object> get props => [];
}

class GetRoomEventRequested extends GetRoomEvent {
  final String idroom;
  const GetRoomEventRequested(@required this.idroom) : assert(idroom != null);
}
